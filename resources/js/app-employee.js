import './bootstrap.js';
import * as library from "./library/library.js";

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const shopCartIcon = document.querySelectorAll('#shopping-cart > *');
const cartMessage = document.querySelector('.cart-message');
const shopCartModal = document.querySelector('#shopping-cart-modal');
const closeCart = document.querySelectorAll('#close-cart > *');
let deliveryRoute = {}
let addedBuyButton = false;

if (library.checkJSON(JSON.parse(localStorage.getItem('deliveryRoute'))) && library.checkJSON(JSON.parse(localStorage.getItem('deliveryRoute')))) {
    cartMessage.innerHTML = ``;
    //console.log(window.location);
    deliveryRoute = JSON.parse(localStorage.getItem('deliveryRoute'));

    for (let route in deliveryRoute) {
        console.log(route);
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

    if (!addedBuyButton) {
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

        addedBuyButton = true;

        const addOrderBtn = document.querySelector('#buy');


        addOrderBtn.addEventListener('click', async () => {

            window.location.href = '/deliveryRoute';
        });
    }


}
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



