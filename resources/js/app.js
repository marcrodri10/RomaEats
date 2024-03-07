import './bootstrap';
import * as library from "./library/library.js";

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


const shopCartIcon = document.querySelectorAll('#shopping-cart > *');
const cartMessage = document.querySelector('.cart-message');
const shopCartModal = document.querySelector('#shopping-cart-modal');
const closeCart = document.querySelectorAll('#close-cart > *');

let addedBuyButton = false;

export let userShopCart = {

};


if (library.checkJSON(JSON.parse(localStorage.getItem('userShopCart'))) && library.checkJSON(JSON.parse(localStorage.getItem('userShopCart')))) {
    cartMessage.innerHTML = ``;
    //console.log(window.location);
    userShopCart = JSON.parse(localStorage.getItem('userShopCart'));

    library.createShopCartCard(userShopCart, cartMessage)

    if (!addedBuyButton) {
        const finishBuyDiv = library.createElement('div');
        const buyButton = library.createElement('button', {
            className: "ms-3 bg-green-700 pt-4 pb-4 pl-10 pr-10 flex justify-center mt-16 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-15",
            textContent: 'FINALIZAR COMPRA',
            id: "buy",
        });

        finishBuyDiv.appendChild(buyButton);
        shopCartModal.appendChild(finishBuyDiv);

        addedBuyButton = true;

        const addOrderBtn = document.querySelector('#buy');

        addOrderBtn.addEventListener('click', async () => {
            const response = await library.sendDataToPhp('/addOrder', userShopCart);
            if (response.message == 'Saved') window.location.href = '/order';
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



