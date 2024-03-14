import { Html5Qrcode } from "html5-qrcode";
import * as library from "../library/library.js";

const productsDiv = document.querySelector("#products-div");
const productDiv = document.querySelector('#product');
const searchForm = document.querySelector('#product-form');
const scanBtn = document.querySelector('#scan-btn');
const productSearch = document.querySelector('#search-product');
const searchBtn = document.querySelector('#search-btn');
const addBtn = document.querySelectorAll('#add-btn > *');
const productForm = document.querySelector('#product-form');
const closeModal = document.querySelectorAll('#close-modal > *');
const shopCartIcon = document.querySelectorAll('#shopping-cart > *');
let html5QrCode;
let buyBtn = false;
const products = document.querySelector('#products');
const cartMessage = document.querySelector('.dish-cart-message');
let userShopCart = {};
const shopCartModal = document.querySelector('#shopping-cart-modal');
const closeCart = document.querySelectorAll('#close-cart > *');
addBtn.forEach(element => {
    element.addEventListener('click', (e) => {
        library.showModal(productForm);
        productsDiv.style.filter = 'blur(5px)';
    })

})

closeModal.forEach(element => {
    element.addEventListener('click', (e) => {
        library.hideModal(productForm);
        productsDiv.style.filter = 'blur(0)';
    })
})
shopCartIcon.forEach(element => {
    element.addEventListener('click', (e) => {
        library.showModal(shopCartModal);

    })

})
closeCart.forEach(element => {
    element.addEventListener('click', (e) => {
        library.hideModal(shopCartModal);

    })
})
if (library.checkJSON(JSON.parse(localStorage.getItem('userShopCart'))) && library.checkJSON(JSON.parse(localStorage.getItem('userShopCart')))) {
    userShopCart = JSON.parse(localStorage.getItem('userShopCart'))
    console.log(userShopCart);
    cartMessage.innerHTML = ``;
    for (let cart in userShopCart) {
        if (cart.includes('product')) {
            console.log(cart);
            const element = document.querySelector('#' + cart);
            const value = element.querySelector('#counter-input').value = userShopCart[cart].quantity;
            const inputs = element.querySelector('.product-quantity').classList.remove('hidden');
        }

    }
    library.createShopCartCard(userShopCart, cartMessage)

    if (!buyBtn) {
        const finishBuyDiv = library.createElement('div', {
            className: 'flex justify-center items-center',
        });
        const buyButton = library.createElement('button', {
            className: "ms-3 bg-green-700 pt-4 pb-4 pl-10 pr-10 flex justify-center mt-16 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-15",
            textContent: 'FINALIZAR COMPRA',
            id: "buy",
        });

        finishBuyDiv.appendChild(buyButton);
        shopCartModal.appendChild(finishBuyDiv);

        buyBtn = true;

        const addOrderBtn = document.querySelector('#buy');

        addOrderBtn.addEventListener('click', async () => {
            const response = await library.sendDataToPhp('/addOrder', userShopCart);
            if (response.message == 'Saved') window.location.href = '/order';
            else if(response.code == 301)  window.location.href = '/login';
        });
    }

}

if(products){
products.addEventListener('click', (e) => {
    const foodDish = e.target.closest('.food-dish');
    let productInfo, buttons;

    if (foodDish) {
        productInfo = foodDish.querySelector('.product-info');
        buttons = e.target.closest('.buttons');
    }
    console.log(productInfo);
    if (e.target.id == "add") {
        let button = document.querySelector('#increment-button');
        let input = buttons.querySelector('#counter-input');
        if(input.value == 0) input.value = 1;
        cartMessage.innerHTML = '';
        let imgSrcSplited = foodDish.querySelector('.dish-image').src.split('/');
        console.log(foodDish.querySelector('.dish-image').src);
        const imgPath = imgSrcSplited[imgSrcSplited.length - 1];
        const id = parseInt(foodDish.id.match(/\d+/)[0]);
        const img = foodDish.querySelector('.dish-image').src;
        buttons.children[1].classList.remove('hidden');
        userShopCart[foodDish.id] = {
            id: id,
            name: productInfo.children[0].textContent.trim(),
            quantity: input.value,
            img: img
        }
        library.createProductShopCartCard(userShopCart, cartMessage)

        localStorage.setItem('userShopCart', JSON.stringify(userShopCart));

        if (!buyBtn) {
            const finishBuyDiv = library.createElement('div', {
                className: 'flex justify-center items-center',
            });
            const buyButton = library.createElement('button', {
                className: "ms-3 bg-green-700 pt-4 pb-4 pl-10 pr-10 flex justify-center mt-16 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-15",
                textContent: "FINALIZAR COMPRA", id: "buy"
            });
            finishBuyDiv.appendChild(buyButton);
            shopCartModal.appendChild(finishBuyDiv);

            buyBtn = true;

            const addOrderBtn = document.querySelector('#buy');
            addOrderBtn.addEventListener('click', async () => {
                const response = await library.sendDataToPhp('/addOrder', userShopCart);
                if (response.message == 'Saved') window.location.href = '/order';
            });
        }
    }
    else if (e.target.closest('#increment-button')) {
        let button = e.target.closest('#increment-button');
        button.parentNode.children[1].value++;

        cartMessage.innerHTML = '';
        let imgSrcSplited = foodDish.querySelector('.dish-image').src.split('/');
        const imgPath = imgSrcSplited[imgSrcSplited.length - 1];
        const id = parseInt(foodDish.id.match(/\d+/)[0]);
        const img = foodDish.querySelector('.dish-image').src;
        userShopCart[foodDish.id] = {
            id: id,
            name: productInfo.children[0].textContent.trim(),
            quantity: button.parentNode.children[1].value,
            img: img
        }

        library.createProductShopCartCard(userShopCart, cartMessage)

        localStorage.setItem('userShopCart', JSON.stringify(userShopCart));



    }
    else if (e.target.closest('#decrement-button')) {
        let button = e.target.closest('#decrement-button');

        if (button.parentNode.children[1].value > 0) {
            button.parentNode.children[1].value--;
            if (button.parentNode.children[1].value >= 1) {
                userShopCart[foodDish.id].quantity = button.parentNode.children[1].value
            }
            else {
                buttons.children[1].classList.add('hidden');
                delete userShopCart[foodDish.id];

            }
            if (Object.entries(userShopCart).length == 0) {
                console.log('sisii');
                console.log(cartMessage);
                cartMessage.innerHTML = `
                <h2>Tu carrito está vacío</h2>
                <button type="submit" value="see-more" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8">
                Seguir Comprando
                </button>
                `;
                document.querySelector('#buy').remove();
                e.target.closest('.product-quantity').classList.add('hidden');
                buyBtn = false;
            }
            else {
                cartMessage.innerHTML = ``;
            }

            library.createShopCartCard(userShopCart, cartMessage)

            localStorage.setItem('userShopCart', JSON.stringify(userShopCart));
        }

    }
})
}
productSearch.addEventListener('input', () => {
    if (productSearch.value.trim().length == 13 && productSearch.value.match(/[*[0-9^]/)) {

        getProduct(productSearch.value);
    }

})
productForm.addEventListener('click', (e) => {
    if(e.target.value == "close"){
        library.hideModal(productForm);
        productsDiv.style.filter = 'blur(0)';
        productDiv.innerHTML = '';
        productSearch.value = '';
    }
})


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
    if (scanBtn.value == 'scan') {
        productDiv.innerHTML = '';
        productSearch.setAttribute('readonly', 'true');
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
                html5QrCode = new Html5Qrcode(/* element id */ "reader");

                await html5QrCode.start(

                    cameraId,
                    {
                        fps: 10,    // Optional, frame per seconds for qr code scanning
                        qrbox: { width: 300, height: 200 }, // Optional, if you want bounded box UI
                    },
                    (decodedText, decodedResult) => {
                        console.log(decodedText);
                        if (decodedText != null || decodedText != undefined) {
                            console.log('hola');
                            productSearch.value = decodedText;
                            console.log(decodedText);
                            html5QrCode.stop().then((ignore) => {
                                // QR Code scanning is stopped.
                            }).catch((err) => {
                                // Stop failed, handle it.
                            });
                            getProduct(productSearch.value);
                        }
                    },
                    (errorMessage) => {
                        // parse error, ignore it.
                    }
                ).catch((err) => {
                    // Start failed, handle it.
                });
                scanBtn.value = "stop"
                scanBtn.textContent = "STOP";

            } else {
                console.log("No se encontraron cámaras disponibles.");
                alert("No se encontraron cámaras disponibles.");
            }
        } catch (err) {
            console.error("Error al obtener las cámaras:", err);
            alert("Error al obtener las cámaras:", err)
            // handle error
        }
    }
    else if (scanBtn.value == 'stop') {
        html5QrCode.stop().then((ignore) => {
            // QR Code scanning is stopped.
        }).catch((err) => {
            // Stop failed, handle it.
        });
        scanBtn.value = "scan";
        scanBtn.textContent = "ESCANEAR";
        productSearch.removeAttribute('readonly');

    }

});




/*
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
                let cat = "";
                if (data.product.categories_imported == null || data.product.categories_imported == undefined) cat = "";
                else cat = data.product.categories_imported
                const finalData = {
                    user_product_code: data.product.id,
                    user_product_name: data.product.product_name_es,
                    user_product_brand: data.product.brands,
                    user_product_category: cat,
                    user_product_store_location: data.product.stores,
                    user_product_nutri_score: data.product.nutriscore_grade
                }

                //library.sendDataToPhp('/save-product', finalData);
            })
    }

});
 */
async function getProduct(id) {

    try {
        const response = await fetch(`https://es.openfoodfacts.org/api/v2/product/${id}`);
        console.log(response);
        if (response.ok) {
            const data = await response.json();
            console.log(data);
            productDiv.innerHTML = `
            <div class="flex items-center justify-center product-info gap-5">
                <div class="img">
                    <img src="${data.product.image_front_thumb_url}">
                </div>
                <div class="info flex flex-col justify-center">
                    <h1>${data.product.product_name_es ? data.product.product_name_es : ''} - ${data.product.quantity ? data.product.quantity : ''}</h1>
                    <p>Código de barras: ${data.product.id}</p>
                </div>
            </div>
            <div class="flex gap-5">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value=${data.product.id} name="search">Sí</button>
                <button type="button" class="bg-red-700 text-white hover:bg-red-800 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="close">No</button>
            </div>`;


        }
    } catch (error) {
        console.error('Error en la llamada fetch:', error);
    }

}

