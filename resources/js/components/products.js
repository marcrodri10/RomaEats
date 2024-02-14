import {Html5Qrcode} from "html5-qrcode";

const productoDiv = document.querySelector('#producto');
const searchForm = document.querySelector('#form');
const scanBtn = document.querySelector('#scan-btn');
const searchInput = document.querySelector('#search');


let detected = false;
let result;
function onScanSuccess(decodedText, decodedResult) {
  // handle the scanned code as you like, for example:
  result = decodedText;

}
function handleResult(result) {
  // Lógica que depende de 'result'
  return result;
}
function stopScanner() {
  if (html5QrcodeScanner) {
    html5QrcodeScanner.stop();
    console.log("Cámara detenida");
  }
}
const formatsToSupport = [
  Html5Qrcode.QR_CODE,
  Html5Qrcode.UPC_A,
  Html5Qrcode.UPC_E,
  Html5Qrcode.UPC_EAN_EXTENSION,
  Html5Qrcode.EAN_13,
];

scanBtn.addEventListener('click', async (e) => {
  e.preventDefault();
  productoDiv.innerHTML = '';
  try {
    // This method will trigger user permissions
    const devices = await Html5Qrcode.getCameras();

    /**
     * devices would be an array of objects of type:
     * { id: "id", label: "label" }
     */
    console.log(devices);

    if (devices && devices.length) {
      const cameraId = devices[0].id;
      const html5QrCode = new Html5Qrcode(/* element id */ "reader");

      html5QrCode.start(

        cameraId,
        {
          fps: 10,    // Optional, frame per seconds for qr code scanning
          qrbox: { width: 600, height: 200 }, // Optional, if you want bounded box UI
        },
        (decodedText, decodedResult) => {
          if (decodedText != null || decodedResult != undefined) {
            searchInput.value = decodedText;
            const spinnerDiv = document.querySelector("#spinner");
            spinnerDiv.innerHTML = `<div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>`;

            console.log(decodedText);
            html5QrCode.stop().then((ignore) => {
              // QR Code scanning is stopped.
            }).catch((err) => {
              // Stop failed, handle it.
            });
            getProduct();
            spinnerDiv.innerHTML = ``;
          }

        },
        (errorMessage) => {
          // parse error, ignore it.
        }
      ).catch((err) => {
        // Start failed, handle it.
      });

    } else {
      console.log("No se encontraron cámaras disponibles.");
    }
  } catch (err) {
    console.error("Error al obtener las cámaras:", err);
    // handle error
  }
});





searchForm.addEventListener('submit', (e) => {
  e.preventDefault();
  let formData = new FormData(searchForm);
  let dataObject = Object.fromEntries(formData.entries());
  console.log(dataObject);
  if (dataObject.search != "") {

    fetch(`https://es.openfoodfacts.org/api/v2/product/${dataObject.search}`)
      .then(response => response.json())
      .then(data => {
        console.log(data);
        const imageDiv = document.createElement("div");
        imageDiv.className = "img";
        const image = document.createElement('img');
        image.src = data.product.image_front_thumb_url;

        imageDiv.appendChild(image);
        productoDiv.appendChild(imageDiv);

        const info = document.createElement('div');
        info.className = 'info';
        const dataArray = ['product_name_es', 'quantity'];
        let dataInfo = {};
        for (let element in data.product) {
          if (dataArray.includes(element)) {
            dataInfo[element] = data.product[element];
          }
        }
        console.log(dataInfo);
        const h1 = document.createElement('h1');

        for (let element in dataInfo) {
          if (dataInfo[element] != '' || dataInfo[element].length != 0) {
            h1.textContent += dataInfo[element] + ' - ';
          }

        }
        h1.textContent = h1.textContent.slice(0, h1.textContent.length - 3)
        info.appendChild(h1);


        const p = document.createElement('p');
        p.textContent = `Código de barras: ${data.product.id}`;
        info.appendChild(p);

        productoDiv.appendChild(info);
        /*  productoDiv.innerHTML = `
             <div class='img'>
                 <img src='${data.product.image_front_thumb_url}'>
             </div>
             <div class='info'>
                 <h1>${data.product.product_name_es} - ${data.product.stores_tags[1].charAt(0).toUpperCase()}${data.product.stores_tags[1].slice(1)} - ${data.product.quantity} </h1>
                 <p>Código de barras: ${data.product.code}</p>
             </div>`; */
      })
  }

});

async function getProduct() {
  let formData = new FormData(searchForm);
  let dataObject = Object.fromEntries(formData.entries());
  console.log(dataObject);
  if (dataObject.search != "") {
    console.log('holaaa');
    try {
      const response = await fetch(`https://es.openfoodfacts.org/api/v2/product/${dataObject.search}`);
      console.log(response);
      if (response.ok) {
        const data = await response.json();
        console.log(data);
         const imageDiv = document.createElement("div");
        imageDiv.className = "img";
        const image = document.createElement('img');
        image.src = data.product.image_front_thumb_url;

        imageDiv.appendChild(image);
        productoDiv.appendChild(imageDiv);

        const info = document.createElement('div');
        info.className = 'info';
        const dataArray = ['product_name_es', 'quantity'];
        let dataInfo = {};
        for (let element in data.product) {
          if (dataArray.includes(element)) {
            dataInfo[element] = data.product[element];
          }
        }
        console.log(dataInfo);
        const h1 = document.createElement('h1');

        for (let element in dataInfo) {
          if (dataInfo[element] != '' || dataInfo[element].length != 0) {
            h1.textContent += dataInfo[element] + ' - ';
          }
        }
        h1.textContent = h1.textContent.slice(0, h1.textContent.length - 3)
        info.appendChild(h1);

        const p = document.createElement('p');
        p.textContent = `Código de barras: ${data.product.id}`;
        info.appendChild(p);

        productoDiv.appendChild(info);
      }
    } catch (error) {
      console.error('Error en la llamada fetch:', error);
    }
  }
}
