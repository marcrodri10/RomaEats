import './bootstrap';
import * as library from "./library/library.js";

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const shopCartIcon = document.querySelectorAll('#shopping-cart > *');

const shopCartModal = document.querySelector('#shopping-cart-modal');
const closeCart = document.querySelectorAll('#close-cart > *');
const main = document.querySelector('main');

shopCartIcon.forEach(element => {
    element.addEventListener('click', (e) => {
        library.showModal(shopCartModal);
        main.style.filter = 'blur(5px)';
    })

})
closeCart.forEach(element => {
    element.addEventListener('click', (e) => {
        library.hideModal(shopCartModal);
        main.style.filter = 'blur(0)';
    })
})

const dishes = document.querySelector('#dishes');
let userShopCart = {

};

dishes.addEventListener('click', (e) => {
    var foodDish = e.target.closest('.food-dish');

    var dishInfo = e.target.closest('.dish-info');

    if (e.target.id == "add") {
        console.log(e.target.nextSibling.nextSibling);
        e.target.nextSibling.nextSibling.classList.remove('hidden');
    }
    else if (e.target.closest('#increment-button')) {
        let button = e.target.closest('#increment-button');
        button.parentNode.children[1].value++;

        var incrementor = e.target.closest('.incrementor');
        console.log(dishInfo);

        shopCartModal.children[1].innerHTML = '';

        userShopCart[foodDish.id] = {
            name: dishInfo.children[0].textContent.trim(),
            price: dishInfo.children[1].textContent.trim(),
            quantity: incrementor.children[1].value,
        }

        for(let cart in userShopCart){
            shopCartModal.children[1].innerHTML += `
            <div class="flex w-90 justify-around items-center gap-3">
                <div class="w-40">
                    <img src = "img/landing1.jpeg">
                </div>
                <div class="w-40">
                    <p>${userShopCart[cart].name}</p>
                    <p>${userShopCart[cart].price}</p>
                    <p>Cantidad: ${userShopCart[cart].quantity}</p>
                </div>
            </div>
            `
        }
    }
    else if (e.target.id == 'decrement-button' || e.target.parentNode.id == 'decrement-button') {
        let button = e.target.closest('#decrement-button');
        if (button.parentNode.children[1].value > 0) button.parentNode.children[1].value--;

    }
})


