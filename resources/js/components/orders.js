import { Loader } from "@googlemaps/js-api-loader"
import * as library from "./../library/library.js";

const loader = new Loader({
    apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY,
    version: "weekly",
    libraries: ['geometry']
});



loader.load().then(async () => {
    const { Map } = await google.maps.importLibrary("maps");
    const location = await getLocation();
    const map = new Map(document.getElementById("map"), {
        center: location,
        zoom: 11,
        mapTypeId: 'roadmap',
        disableDefaultUI: true,
    });
    let circle;
    /* geocodeAddress('Avinguda de la Riera de Sant Llorenç, 120, 3º 1ª')
    .then(coords => {
        console.log(coords);
        var distance = google.maps.geometry.spherical.computeDistanceBetween(circle.getCenter(), coords);
        console.log(distance);

    }) */




    const rangeKm = document.querySelector('#km-range');
    let rangeValue = document.querySelector('#range-value');
    if (localStorage.getItem('range')) {
        rangeKm.value = localStorage.getItem('range');
        rangeValue.textContent = rangeKm.value + 'km';
    }
    circle = setMapCircle(map, location, parseInt(rangeKm.value));

    const response = await library.fetchPhp('/allOrderAddress');
    let markedAddresses = [];
    const ordersDiv = document.querySelector('#orders');



    if (ordersDiv) ordersDiv.innerHTML = ``;
    if (response.message.length > 0) {
        let routeFarthest;
        let distanceFarthest = 0;
        for (let address in response.message) {
            const coords = await geocodeAddress(response.message[address].order_address)

            var distance = google.maps.geometry.spherical.computeDistanceBetween(circle.getCenter(), coords);

            if (distance < parseInt(rangeKm.value) * 1000) {

                ordersDiv.innerHTML += `
            <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 order mt-5" id="product{{$id}}">
    <div class="order-info p-3 flex flex-col justify-between">
        <div class="">
            <h2 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">${response.message[address].order_dish_code} </h2>
        </div>

        <div class="flex-col items-center">
            <p class=" font-normal text-gray-700 dark:text-gray-400">${response.message[address].phone == null ? '' : response.message[address].phone}</p>
            <p class=" font-normal text-gray-700 dark:text-gray-400">${response.message[address].order_status}</p>

            <p class=" font-normal text-gray-700 dark:text-gray-400">${response.message[address].name} ${response.message[address].surname}</p>
            <p class=" font-normal text-gray-700 dark:text-gray-400">${response.message[address].order_address == null ? '' : response.message[address].order_address}</p>
            <p class=" font-normal text-gray-700 dark:text-gray-400">${response.message[address].phone == null ? '' : response.message[address].phone}</p>
        </div>
        <div class="buttons flex justify-between mt-6">
            <form action="/route/${response.message[address].order_id}" method="post">
                <button value="${response.message[address].order_id}" class="select-btn inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8">SELECCIONAR</button>
            </form>
            <button type="button" value="${response.message[address].order_id}" class="select-btn inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8" id="add-route">AÑADIR</button>
        </div>
    </div>
</div>
            `
                const button = document.querySelectorAll('#add-route');
                for(let i in button){
                    if(JSON.parse(localStorage.getItem('deliveryRoute'))){
                        if(JSON.parse(localStorage.getItem('deliveryRoute'))['route'+button[i].value]){
                            button[i].id = 'delete-route';
                            button[i].textContent = 'ELIMINAR'
                        }
                    }

                }

                let marker = addMarker(coords, map, address);
                if (distance >= distanceFarthest) {
                    routeFarthest = coords;
                }
            }

        }

    }



    rangeKm.addEventListener("change", async () => {
        localStorage.setItem('range', rangeKm.value);
        if(ordersDiv) ordersDiv.innerHTML = ``;

        rangeValue.textContent = rangeKm.value + ' km';
        circle.setMap(null);

        circle = setMapCircle(map, location, parseInt(rangeKm.value));

        for (let address in response.message) {
            const coords = await geocodeAddress(response.message[address].order_address)

            var distance = google.maps.geometry.spherical.computeDistanceBetween(circle.getCenter(), coords);

            if (distance < parseInt(rangeKm.value) * 1000) {

                const encontrado = markedAddresses.filter(name => name.title === 'Marker' + address);

                if (encontrado.length > 0) {

                }
                else {
                    let marker = addMarker(coords, map, address);
                    markedAddresses.push(marker);
                }
                ordersDiv.innerHTML += `
            <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 order mt-5" id="product{{$id}}">
    <div class="order-info p-3 flex flex-col justify-between">
        <div class="">
            <h2 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">${response.message[address].order_dish_code} </h2>
        </div>

        <div class="flex-col items-center">
            <p class=" font-normal text-gray-700 dark:text-gray-400">${response.message[address].phone == null ? '' : response.message[address].phone}</p>
            <p class=" font-normal text-gray-700 dark:text-gray-400">${response.message[address].order_status}</p>

            <p class=" font-normal text-gray-700 dark:text-gray-400">${response.message[address].name} ${response.message[address].surname}</p>
            <p class=" font-normal text-gray-700 dark:text-gray-400">${response.message[address].order_address == null ? '' : response.message[address].order_address}</p>
            <p class=" font-normal text-gray-700 dark:text-gray-400">${response.message[address].phone == null ? '' : response.message[address].phone}</p>
        </div>
        <div class="buttons flex justify-between mt-6">
        <form action="/route/${response.message[address].order_id}" method="post">
            <button value="${response.message[address].order_id}" class="select-btn inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8">SELECCIONAR</button>
        </form>
        <button type="button" value="${response.message[address].order_id}" class="select-btn inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8" id="add-route">AÑADIR</button>
        </div>
    </div>
</div>
            `
            } else {
                const encontradoIndex = markedAddresses.findIndex(name => name.title === 'Marker' + address);
                if (encontradoIndex !== -1) {
                    markedAddresses[encontradoIndex].setMap(null);
                    markedAddresses.splice(encontradoIndex, 1);

                }
            }
        }
    });
    let deliveryRoute = {};
    let buyBtn = false;
    const shopCartModal = document.querySelector('#shopping-cart-modal');
    const cartMessage = document.querySelector('.cart-message');
    if (library.checkJSON(JSON.parse(localStorage.getItem('deliveryRoute'))) && library.checkJSON(JSON.parse(localStorage.getItem('deliveryRoute')))) {
        cartMessage.innerHTML = ``;
        //console.log(window.location);
        deliveryRoute = JSON.parse(localStorage.getItem('deliveryRoute'));

        for (let route in deliveryRoute) {
            const { code, user, address } = deliveryRoute[route];
            const productCartCard = library.createElement('div', { className: 'flex w-90 justify-around items-center gap-3 product-cart-card' });
            productCartCard.innerHTML = `
            <div class="w-40">
                <img src="img/marker.svg">
            </div>
            <div class="flex-col w-40">
                <p>${code}</p>
                <p>${user}</p>
                <p>${address}</p>
            </div>
        `;
            cartMessage.appendChild(productCartCard);
        }

        if (!buyBtn) {
            const finishBuyDiv = library.createElement('div', {
                className: 'flex justify-center items-center',
            });
            const buyButton = library.createElement('button', {
                className: "ms-3 bg-green-700 pt-4 pb-4 pl-10 pr-10 flex justify-center mt-16 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-15",
                textContent: 'COMENZAR RUTA',
                id: "buy",
            });

            finishBuyDiv.appendChild(buyButton);
            shopCartModal.appendChild(finishBuyDiv);

            buyBtn = true;

            const addOrderBtn = document.querySelector('#buy');


            addOrderBtn.addEventListener('click', async () => {

                if(Object.entries(deliveryRoute).length <= 1) alert('Tiene que haber mínimo 2 localizaciones en la ruta')
                else window.location.href = '/deliveryRoute';

            });
        }


    }
    if (ordersDiv) {
        ordersDiv.addEventListener('click', (e) => {

            if (e.target.id == "add-route") {
                shopCartModal.children[1].innerHTML = '';
                const cardData = e.target.closest('.order-info');

                deliveryRoute['route' + e.target.value] = {
                    code: cardData.children[0].children[0].textContent,
                    user: cardData.children[1].children[2].textContent,
                    address: cardData.children[1].children[3].textContent,
                }

                for (let route in deliveryRoute) {
                    const { code, user, address } = deliveryRoute[route];
                    const productCartCard = library.createElement('div', { className: 'flex w-90 justify-around items-center gap-3 product-cart-card' });
                    productCartCard.innerHTML = `
                    <div class="w-40">
                        <img src="img/marker.svg">
                    </div>
                    <div class="flex-col w-40">
                        <p>${code}</p>
                        <p>${user}</p>
                        <p>${address}</p>
                    </div>
                `;
                    cartMessage.appendChild(productCartCard);
                }
                localStorage.setItem('deliveryRoute', JSON.stringify(deliveryRoute));
                if (!buyBtn) {
                    const finishBuyDiv = library.createElement('div', {
                        className: 'w-100 flex justify-center items-center'
                    });
                    const buyButton = library.createElement('button', {
                        className: "ms-3 bg-green-700 pt-4 pb-4 pl-10 pr-10 flex justify-center mt-16 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-15",
                        textContent: "COMENZAR RUTA", id: "buy"
                    });
                    finishBuyDiv.appendChild(buyButton);
                    shopCartModal.appendChild(finishBuyDiv);

                    buyBtn = true;

                    const addOrderBtn = document.querySelector('#buy');
                    addOrderBtn.addEventListener('click', async () => {
                        if(Object.entries(deliveryRoute).length <= 1) alert('Tiene que haber mínimo 2 localizaciones en la ruta')
                        else window.location.href = '/deliveryRoute';
                    });
                }

                e.target.textContent = 'ELIMINAR';
                e.target.id = 'delete-route';
            }
            else if (e.target.id == "delete-route") {
                delete deliveryRoute['route' + e.target.value];
                cartMessage.innerHTML = '';
                if (Object.entries(deliveryRoute).length == 0) {
                    document.querySelector('#buy').remove();
                    cartMessage.innerHTML = `
                    <h2>Todavía no hay rutas</h2>
                    <button type = 'button' value = 'see-more' class = 'ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'>
                        Añadir rutas
                    </button>
                    `
                    buyBtn = false;
                }

                e.target.textContent = 'AÑADIR';
                e.target.id = 'add-route';

                for (let route in deliveryRoute) {
                    const { address } = deliveryRoute[route];
                    const productCartCard = library.createElement('div', { className: 'flex w-90 justify-around items-center gap-3 product-cart-card' });
                    productCartCard.innerHTML = `
                    <div class="w-40">
                        <img src="img/marker.svg">
                    </div>
                    <div class="flex-col w-40">
                        <p>${address}</p>
                    </div>
                `;
                    cartMessage.appendChild(productCartCard);
                }
                localStorage.setItem('deliveryRoute', JSON.stringify(deliveryRoute));

            }
        })
    }



})






function getLocation() {
    return new Promise((resolve, reject) => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    var accuracy = position.coords.accuracy;
                    var coords = new google.maps.LatLng(latitude, longitude);
                    resolve(coords); // Resuelve la promesa con las coordenadas
                },
                function error(msg) {
                    reject('Please enable your GPS position feature.');
                },
                { maximumAge: 10000, timeout: 5000, enableHighAccuracy: true }
            );
        } else {
            reject('Geolocation is not supported by this browser.');
        }
    });
}


function addMarker(location, map, title, icon = null) {
    // Crear un marcador y colocarlo en el mapa
    if (icon != null) {
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            title: 'Marker' + title,
            animation: google.maps.Animation.DROP,
            icon: {
                url: `../img/${icon}`,
                scaledSize: new google.maps.Size(50, 50),
            }
        });
    }
    else {
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            title: 'Marker' + title,
            //animation: google.maps.Animation.DROP,
        });
    }

    return marker;
}
function calcularDistancia(lat1, lon1, lat2, lon2) {
    var radioTierra = 6371; // Radio de la Tierra en kilómetros
    var dLat = (lat2 - lat1) * Math.PI / 180;
    var dLon = (lon2 - lon1) * Math.PI / 180;
    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var distancia = radioTierra * c;
    return distancia;
}
function calcRoute(a, b, map) {
    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer({
        map: map,
        polylineOptions: {
            strokeColor: '#FF0000',  // Cambiar el color de la línea
            strokeWeight: 10,         // Cambiar el grosor de la línea
            strokeOpacity: 0.7,      // Cambiar la opacidad de la línea
        },
    });
    directionsRenderer.setMap(map);

    const request = {
        origin: a,
        destination: b,
        travelMode: 'DRIVING',
    };
    directionsService.route(request, function (result, status) {
        if (status == 'OK') {
            directionsRenderer.setDirections(result);
        } else {
            console.error('Error al calcular la ruta:', status);
        }
    });
}
// Función para verificar si una posición está dentro de un radio dado de otra posición
function estaDentroDeRadio(posicionActual, posicionesGuardadas, radioKm, map) {
    for (var i = 0; i < posicionesGuardadas.length; i++) {
        var distancia = calcularDistancia(
            posicionActual.lat,
            posicionActual.lng,
            posicionesGuardadas[i].lat,
            posicionesGuardadas[i].lng
        );

        if (distancia <= radioKm) {
            addMarker({ lat: posicionesGuardadas[i].lat, lng: posicionesGuardadas[i].lng }, map)
            calcRoute(posicionActual, { lat: posicionesGuardadas[i].lat, lng: posicionesGuardadas[i].lng }, map);

        }
    }
    return false; // La posición actual no está dentro del radio de x km de ninguna posición guardada
}

function setMapCircle(map, location, radius) {
    let circle = new google.maps.Circle({
        strokeColor: '#FF0000', // Color del borde
        strokeOpacity: 0.8,     // Opacidad del borde
        strokeWeight: 2,        // Grosor del borde
        fillColor: '#FF0000',   // Color de relleno
        fillOpacity: 0.35,      // Opacidad de relleno
        map: map,
        center: location,
        radius: radius * 1000           // Radio en metros

    })
    return circle;
}

function geocodeAddress(address) {
    return new Promise((resolve, reject) => {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'address': address }, function (results, status) {
            if (status === 'OK') {
                var location = results[0].geometry.location;
                resolve({ lat: location.lat(), lng: location.lng() });
            } else {
                reject("Geocodificación fallida debido a: " + status);
            }
        });
    });
}
