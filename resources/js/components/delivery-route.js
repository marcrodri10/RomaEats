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
    const deliveryRoute = JSON.parse(localStorage.getItem("deliveryRoute"));
    console.log(deliveryRoute);

    const mapInfo = document.querySelector("#map-info");
    addMarker(location, map, 0, 'circle.svg');
    let circle = setMapCircle(map, location, 50);
    let routeFarthest;
    let distanceFarthest = 0;
    let routeLocation = [];
    for (let route in deliveryRoute) {
        const coords = await geocodeAddress(deliveryRoute[route].address)

        var distance = google.maps.geometry.spherical.computeDistanceBetween(circle.getCenter(), coords);
        console.log(deliveryRoute[route].address);
        if (distance >= distanceFarthest) {
            routeFarthest = {
                coords: coords,
                address: deliveryRoute[route].address,
            }
            distanceFarthest = distance;
        }
        routeLocation.push(coords);
    }
    console.log(routeFarthest);
    if (Object.entries(deliveryRoute).length > 1) {

        let waypoints = routeLocation.filter((route) => {
            console.log(route.lat);
            console.log(routeFarthest.coords.lat);
            return route.lat != routeFarthest.coords.lat && route.lng != routeFarthest.coords.lng
        })


        waypoints = waypoints.map(function (location) {
            return {
                location: location,
                stopover: true
            };
        });
        console.log(waypoints);
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
                console.log(result);
                mapInfo.innerHTML = `
                ${result.routes[0].legs[0].distance.text}
                ${result.routes[0].legs[0].duration.text}`;
                console.log(result.routes[0].overview_path.length);
                let time = 0;
                for (let leg in result.routes[0].legs) {
                    time += result.routes[0].legs[leg].duration.value;
                }
                let routePath = [];
                for (let leg in result.routes[0].legs) {
                    for (let step in result.routes[0].legs[leg].steps) {
                        for (let path in result.routes[0].legs[leg].steps[step].path) {

                            routePath.push(result.routes[0].legs[leg].steps[step].path[path]);
                        }
                    }
                }

                const routeProgress = parseFloat(time / routePath.length).toFixed(3);
                console.log(routeProgress);

                let i = 0;
                let routeMarkers = [];
                const finishLocation = {
                    lat: result.routes[0].legs[result.routes[0].legs.length - 1].end_location.lat(),
                    lng: result.routes[0].legs[result.routes[0].legs.length - 1].end_location.lng(),
                }
                console.log(finishLocation);

                let interval = setInterval(() => {
                    if (routeMarkers.length != 0) {
                        routeMarkers[0].setMap(null);
                        routeMarkers.splice(0, 1)
                    }


                    let position = {
                        lat: routePath[i].lat(),
                        lng: routePath[i].lng(),
                    }
                    var distanciaEnMetros = google.maps.geometry.spherical.computeDistanceBetween(finishLocation, position);
                    console.log(distanciaEnMetros);
                    console.log(position.lat, finishLocation.lat, position.lng, finishLocation.lng);
                    console.log(position.lat == finishLocation.lat && position.lng == finishLocation.lng);
                    if (distanciaEnMetros < 1) {
                        console.log('ha llegado');
                        clearInterval(interval);
                    }
                    let rMarker = addMarker(position, map, 0, 'circle.svg');
                    routeMarkers.push(rMarker);

                    i++;
                }, routeProgress * 1000)
                for(let path in routePath){
                    //console.log(path, JSON.parse(JSON.stringify(routePath[path])));
                    //addMarker(JSON.parse(JSON.stringify(routePath[path])), map, 0);
                }
                console.log(JSON.parse(JSON.stringify(result.request.destination.location)));
                for (let step of result.routes[0].legs[0].steps) {

                    mapInfo.innerHTML += `${step.instructions}<br>`
                }
            } else {
                console.error('Error al calcular la ruta:', status);
            }
        });
    }
    else {
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
            destination: routeLocation[0],
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
                const TIME = result.routes[0].legs[0].duration.value;

                console.log(TIME);
                const routeProgress = parseFloat(TIME / result.routes[0].overview_path.length).toFixed(3);
                console.log(routeProgress);

                let i = 0;
                let routeMarkers = [];
                const finishLocation = {
                    lat: parseFloat(result.routes[0].legs[0].end_location.lat().toFixed(5)),
                    lng: parseFloat(result.routes[0].legs[0].end_location.lng().toFixed(5)),
                }
                let interval = setInterval(() => {
                    if (routeMarkers.length != 0) {
                        routeMarkers[0].setMap(null);
                        routeMarkers.splice(0, 1)
                    }


                    let position = {
                        lat: result.routes[0].overview_path[i].lat(),
                        lng: result.routes[0].overview_path[i].lng(),
                    }
                    console.log(position.lat == finishLocation.lat && position.lng == finishLocation.lng);
                    if (position.lat == finishLocation.lat && position.lng == finishLocation.lng) {
                        console.log('ha llegado');
                        clearInterval(interval);
                    }
                    let rMarker = addMarker(position, map, 0, 'circle.svg');
                    routeMarkers.push(rMarker);

                    i++;
                }, routeProgress * 1000)

                console.log(JSON.parse(JSON.stringify(result.request.destination.location)));
                for (let step of result.routes[0].legs[0].steps) {

                    mapInfo.innerHTML += `${step.instructions}<br>`
                }
            } else {
                console.error('Error al calcular la ruta:', status);
            }
        });
    }
    /* const directionsService = new google.maps.DirectionsService();
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
            const TIME = result.routes[0].legs[0].duration.value;

            console.log(TIME);
            const routeProgress = parseFloat(TIME / result.routes[0].overview_path.length).toFixed(3);
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
                    lat: result.routes[0].overview_path[i].lat(),
                    lng: result.routes[0].overview_path[i].lng(),
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

            console.log(coords);

            console.log(JSON.parse(JSON.stringify(result.request.destination.location)));
            for(let step of result.routes[0].legs[0].steps){

                mapInfo.innerHTML += `${step.instructions}<br>`
            }
        } else {
            console.error('Error al calcular la ruta:', status);
        }
    }); */

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
