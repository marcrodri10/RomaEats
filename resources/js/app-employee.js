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



