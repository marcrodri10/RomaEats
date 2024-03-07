import * as library from "./../library/library.js";

const dishes = document.querySelector('#dishes');
const shopCartModal = document.querySelector('#shopping-cart-modal');
const cartMessage = document.querySelector('.cart-message');
let buyBtn = false;
import { userShopCart } from "../app.js";

if (library.checkJSON(JSON.parse(localStorage.getItem('userShopCart'))) && library.checkJSON(JSON.parse(localStorage.getItem('userShopCart')))) {
    buyBtn = true;

    let pageDishesIds = [];
    const dishes = document.querySelectorAll('.dishes > .food-dish');

    dishes.forEach(element => {
        pageDishesIds.push(element.id)
    })
    for (let cart in userShopCart) {
        if (pageDishesIds.includes(cart)) {
            console.log('ohla');
            const element = document.querySelector('#' + cart);
            const value = element.querySelector('#counter-input').value = userShopCart[cart].quantity;
            const inputs = element.querySelector('.product-quantity').classList.remove('hidden');
        }

    }

}


dishes.addEventListener('click', (e) => {
    const foodDish = e.target.closest('.food-dish');
    const dishInfo = foodDish.querySelector('.dish-info');
    const buttons = e.target.closest('.buttons');

    if (e.target.id == "add") {
        buttons.children[1].classList.remove('hidden');
    }
    else if (e.target.closest('#increment-button')) {
        let button = e.target.closest('#increment-button');
        button.parentNode.children[1].value++;

        shopCartModal.children[1].innerHTML = '';
        console.log();
        let imgSrcSplited = foodDish.querySelector('.dish-image').src.split('/');
        const imgPath = imgSrcSplited[imgSrcSplited.length - 1];
        const id = parseInt(foodDish.id.match(/\d+/)[0]);

        userShopCart[foodDish.id] = {
            id: id,
            name: dishInfo.children[0].textContent.trim(),
            price: dishInfo.children[1].textContent.trim(),
            quantity: button.parentNode.children[1].value,
        }

        library.createShopCartCard(userShopCart, cartMessage)

        localStorage.setItem('userShopCart', JSON.stringify(userShopCart));

        if (!buyBtn) {
            const finishBuyDiv = document.createElement('div');
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
                shopCartModal.children[1].innerHTML = `
                <h2>Tu carrito está vacío</h2>
                <button type="submit" value="see-more" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8">
                Seguir Comprando
                </button>
                `;
                shopCartModal.children[2].remove();
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
