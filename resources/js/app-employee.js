import './bootstrap.js';
import * as library from "./library/library.js";

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const shopCartIcon = document.querySelectorAll('#shopping-cart > *');
const cartMessage = document.querySelector('.cart-message');
const shopCartModal = document.querySelector('#shopping-cart-modal');
const closeCart = document.querySelectorAll('#close-cart > *');
const main = document.querySelector('main');

let addedBuyButton = false;

export let userShopCart = {

};


if (localStorage.getItem('userShopCart') !== null && Object.entries(JSON.parse(localStorage.getItem('userShopCart'))).length != 0) {
    cartMessage.innerHTML = ``;
    userShopCart = JSON.parse(localStorage.getItem('userShopCart'));
    for (let cart in userShopCart) {
        const { name, price, quantity } = userShopCart[cart];
        const productCartCard = library.createElement('div', { className: 'flex w-90 justify-around items-center gap-3 product-cart-card' });
        productCartCard.innerHTML = `
            <div class="w-40">
                <img src="img/landing1.jpeg">
            </div>
            <div class="flex-col w-40">
                <p>${name}</p>
                <p>${price}</p>
                <p>${quantity}</p>
            </div>
        `;
        cartMessage.appendChild(productCartCard);

    }
    if (!addedBuyButton) {
        const finishBuyDiv = document.createElement('div');
        const buyButton = document.createElement('button');
        buyButton.className = "ms-3 bg-green-700 pt-4 pb-4 pl-10 pr-10 flex justify-center mt-16 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-15";
        buyButton.textContent = 'FINALIZAR COMPRA';
        buyButton.id = "buy";
        finishBuyDiv.appendChild(buyButton);
        shopCartModal.appendChild(finishBuyDiv);

        addedBuyButton = true;
    }
    const buyButton = document.querySelector('#buy');

    buyButton.addEventListener('click', async () => {
        const response = await library.sendDataToPhp('/addOrder', userShopCart);
        if(response.message == 'Saved') window.location.href = '/order';
    });

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



