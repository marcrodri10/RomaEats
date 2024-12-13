import { Loader } from "@googlemaps/js-api-loader"
import * as library from "../library/library.js";

const loader = new Loader({
    apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY,
    version: "weekly",
    libraries: ['geometry']
});



loader.load().then(async () => {
    const { Map } = await google.maps.importLibrary("maps");
    const location = await getLocation()
    const map = new Map(document.getElementById("map"), {
        center: location,
        zoom: 11,
        mapTypeId: 'roadmap',
        disableDefaultUI: true,
    });
    const deliveryRoute = JSON.parse(localStorage.getItem("deliveryRoute"));

    let routeCode = [];
    for(let route in deliveryRoute) {

        routeCode.push(deliveryRoute[route].code.trim())
    }

    const setOrderDelivery = library.sendDataToPhp('/updateOrder', routeCode);
    const mapInfo = document.querySelector("#map-info");
    //addMarker(location, map, 0, 'circle.svg');
    let circle = setMapCircle(map, location, 50);
    let routeFarthest;
    let distanceFarthest = 0;
    let routeLocation = [];
    for (let route in deliveryRoute) {
        const coords = await geocodeAddress(deliveryRoute[route].address)

        var distance = google.maps.geometry.spherical.computeDistanceBetween(circle.getCenter(), coords);

        if (distance >= distanceFarthest) {
            routeFarthest = {
                coords: coords,
                address: deliveryRoute[route].address,
            }
            distanceFarthest = distance;
        }
        routeLocation.push(coords);
    }

    if (Object.entries(deliveryRoute).length > 1) {

        let waypoints = routeLocation.filter((route) => {
            return route.lat != routeFarthest.coords.lat && route.lng != routeFarthest.coords.lng
        })


        waypoints = waypoints.map(function (location) {
            return {
                location: location,
                stopover: true
            };
        });

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
            origin: location,
            destination: routeFarthest.coords,
            waypoints: waypoints,
            optimizeWaypoints: true,
            travelMode: 'DRIVING',
        };

        directionsService.route(request, function (result, status) {
            if (status == 'OK') {
                directionsRenderer.setDirections(result);

                let time = 0;
                let distance = 0;
                for (let leg in result.routes[0].legs) {
                    time += result.routes[0].legs[leg].duration.value;
                    distance +=  result.routes[0].legs[leg].distance.value
                }
                let routePath = [];
                for (let leg in result.routes[0].legs) {
                    for (let step in result.routes[0].legs[leg].steps) {
                        for (let path in result.routes[0].legs[leg].steps[step].path) {

                            routePath.push(result.routes[0].legs[leg].steps[step].path[path]);
                        }
                    }
                }
                mapInfo.innerHTML = `
                Distancia total: ${Math.round(distance/1000)} km<br>
                Tiempo total: ${Math.round(time / 60)} min<br>`;

                const routeProgress = parseFloat(time / routePath.length).toFixed(3);

                let i = 0;
                let routeMarkers = [];
                const finishLocation = {
                    lat: result.routes[0].legs[result.routes[0].legs.length - 1].end_location.lat(),
                    lng: result.routes[0].legs[result.routes[0].legs.length - 1].end_location.lng(),
                }

                for (let leg in result.routes[0].legs) {
                    for (let step in result.routes[0].legs[leg].steps) {
                        mapInfo.innerHTML += `${result.routes[0].legs[leg].steps[step].instructions}<br>`
                    }
                }




            } else {
                console.error('Error al calcular la ruta:', status);
            }
        });
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
                scaledSize: new google.maps.Size(25, 25),
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
function setMapCircle(map, location, radius) {
    let circle = new google.maps.Circle({
        strokeOpacity: 0,     // Opacidad del borde
        strokeWeight: 2,        // Grosor del borde
        fillOpacity: 0,      // Opacidad de relleno
        map: map,
        center: location,
        radius: radius * 1000           // Radio en metros

    })
    return circle;
}
