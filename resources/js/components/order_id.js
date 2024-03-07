import { Loader } from "@googlemaps/js-api-loader"
import * as library from "../library/library.js";

const loader = new Loader({
    apiKey: "AIzaSyBlIHHRKg4PQdcHB8Ogsdof6-n1SXu2aOk",
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

    const address = document.querySelector("#address").textContent;
    const coords = await geocodeAddress(address);
    const mapInfo = document.querySelector("#map-info");
    addMarker(location, map, 0, 'circle.svg');
    addMarker(coords, map, 1);

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
        destination: coords,
        travelMode: 'DRIVING',
    };

    directionsService.route(request, function (result, status) {
        if (status == 'OK') {
            directionsRenderer.setDirections(result);
            console.log(result);
            mapInfo.innerHTML = `
            ${result.routes[0].legs[0].distance.text}
            ${result.routes[0].legs[0].duration.text}`;
            console.log(result.routes[0].overview_path.length);
            let routePath = [];
            for (let step in result.routes[0].legs[0].steps){
                for(let path in result.routes[0].legs[0].steps[step].path){
                    routePath.push(result.routes[0].legs[0].steps[step].path[path]);
                }
            }

            console.log(routePath);
            const TIME = result.routes[0].legs[0].duration.value;

            console.log(TIME);
            const routeProgress = parseFloat(50 / routePath.length).toFixed(3);
            console.log(routeProgress);

            let i = 0;
            let routeMarkers = [];
            const finishLocation = {
                lat: parseFloat(result.routes[0].legs[0].end_location.lat().toFixed(5)),
                lng: parseFloat(result.routes[0].legs[0].end_location.lng().toFixed(5)),
            }

            let interval = setInterval(() => {
                if(routeMarkers.length != 0){
                    routeMarkers[0].setMap(null);
                    routeMarkers.splice(0, 1)
                }


                let position = {
                    lat: routePath[i].lat(),
                    lng: routePath[i].lng(),
                }
                console.log(position.lat == finishLocation.lat && position.lng == finishLocation.lng);
                if(position.lat == finishLocation.lat && position.lng == finishLocation.lng) {
                    console.log('ha llegado');
                    clearInterval(interval);
                }
                let rMarker = addMarker(position, map, 0, 'circle.svg');
                routeMarkers.push(rMarker);

                i++;
            }, routeProgress*1000)
            /* for(let path in result.routes[0].overview_path){
                console.log(path, JSON.parse(JSON.stringify(result.routes[0].overview_path[path])));
                addMarker(JSON.parse(JSON.stringify(result.routes[0].overview_path[path])), map, 0);
            } */
            console.log(coords);

            console.log(JSON.parse(JSON.stringify(result.request.destination.location)));
            for(let step of result.routes[0].legs[0].steps){

                mapInfo.innerHTML += `${step.instructions}<br>`
            }
        } else {
            console.error('Error al calcular la ruta:', status);
        }
    });

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
    if(icon != null) {
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
