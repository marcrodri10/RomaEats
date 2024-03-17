import * as library from "./../library/library.js";
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
const dishes = document.querySelector('#dishes');
const shopCartModal = document.querySelector('#shopping-cart-modal');
const cartMessage = document.querySelector('.dish-cart-message');
let buyBtn = false;
const search = document.querySelector('#default-search');
const dishesValues = getAllDishes();
let userShopCart = {};
const closeCart = document.querySelectorAll('#close-cart > *');
const shopCartIcon = document.querySelectorAll('#shopping-cart > *');
const continueBtn = document.querySelector('#continue');

if (continueBtn){
    continueBtn.addEventListener('click', () => {
        window.location.href = '/dishes';
    })
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

if(search){
    search.addEventListener('keyup', async () => {
        dishes.innerHTML = '';
        const val = search.value.trim();
        let total = 0;
        for (let dish in dishesValues) {

            if (dishesValues[dish].dish_name.toLowerCase().includes(val)) {
                if (total < 5) {
                    library.generateDishCard(dishes, dishesValues[dish]);
                    let pageDishesIds = [];
                    const dishes_ = document.querySelectorAll('.dishes > .food-dish');
                    dishes_.forEach(element => {
                        pageDishesIds.push(element.id)
                    })
                    for (let cart in userShopCart) {
                        if (pageDishesIds.includes(cart)) {
                            const element = document.querySelector('#' + cart);
                            const value = element.querySelector('#counter-input').value = userShopCart[cart].quantity;
                            const inputs = element.querySelector('.product-quantity').classList.remove('hidden');
                        }

                    }
                }

                total++;
            }
        }
        if(total == 0){
            const paginator = document.querySelector('#paginator');
            paginator.classList.add('hidden');
            const message = document.createElement('p');
            message.textContent = 'Lo sentimos. No hemos encontrado ningún plato con ese nombre.';
            dishes.classList.remove('card-group');
            message.className = "text-center"
            dishes.appendChild(message);
        }
        else {
            paginator.classList.remove('hidden');
            dishes.classList.add('card-group');
        }

    })
}

if (library.checkJSON(JSON.parse(localStorage.getItem('userShopCart'))) && library.checkJSON(JSON.parse(localStorage.getItem('userShopCart')))) {

    userShopCart = JSON.parse(localStorage.getItem('userShopCart'))
    let pageDishesIds = [];
    const dishes = document.querySelectorAll('.dishes > .food-dish');

    dishes.forEach(element => {
        pageDishesIds.push(element.id)
    })
    for (let cart in userShopCart) {
        if (pageDishesIds.includes(cart)) {
            if(cart.includes('dish')){
                const element = document.querySelector('#' + cart);
                const value = element.querySelector('#counter-input').value = userShopCart[cart].quantity;
                const inputs = element.querySelector('.product-quantity').classList.remove('hidden');
            }
        }

    }
    cartMessage.innerHTML = ``;
    library.createShopCartCard(userShopCart, cartMessage)

    if (!buyBtn) {
        const finishBuyDiv = library.createElement('div', {
            className: 'flex justify-center items-center',
        });
        const buyButton = library.createElement('button', {
            className: "ms-3 bg-green-700 pt-4 pb-4 pl-10 pr-10 flex justify-center mt-16 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-15",
            textContent: 'FINALIZAR COMPRA',
            id: "buy",
        });

        finishBuyDiv.appendChild(buyButton);
        shopCartModal.appendChild(finishBuyDiv);

        buyBtn = true;

        const addOrderBtn = document.querySelector('#buy');
        addOrderBtn.addEventListener('click', async () => {
            sendOrder();
        });
    }

}


dishes.addEventListener('click', (e) => {
    const foodDish = e.target.closest('.food-dish');
    let dishInfo, buttons;

    if (foodDish) {
        dishInfo = foodDish.querySelector('.dish-info');
        buttons = e.target.closest('.buttons');
    }
    if (e.target.id == "add") {
        let button = document.querySelector('#increment-button');
        let input = buttons.querySelector('#counter-input');
        if(input.value == 0) input.value = 1;
        cartMessage.innerHTML = '';
        let imgSrcSplited = foodDish.querySelector('.dish-image').src.split('/');
        const imgPath = imgSrcSplited[imgSrcSplited.length - 1];
        const id = parseInt(foodDish.id.match(/\d+/)[0]);
        buttons.children[1].classList.remove('hidden');
        userShopCart[foodDish.id] = {
            id: id,
            name: dishInfo.children[0].textContent.trim(),
            price: dishInfo.children[1].textContent.trim(),
            quantity: input.value,
        }
        library.createShopCartCard(userShopCart, cartMessage, 'dish')

        localStorage.setItem('userShopCart', JSON.stringify(userShopCart));

        if (!buyBtn) {

            const finishBuyDiv = library.createElement('div', {
                className: 'flex justify-center items-center',
            });
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
                else if(response.code == 301)  window.location.href = '/login';
            });
        }
    }
    else if (e.target.closest('#increment-button')) {
        let button = e.target.closest('#increment-button');
        button.parentNode.children[1].value++;

        cartMessage.innerHTML = '';
        let imgSrcSplited = foodDish.querySelector('.dish-image').src.split('/');
        const imgPath = imgSrcSplited[imgSrcSplited.length - 1];
        const id = parseInt(foodDish.id.match(/\d+/)[0]);

        userShopCart[foodDish.id] = {
            id: id,
            name: dishInfo.children[0].textContent.trim(),
            price: dishInfo.children[1].textContent.trim(),
            quantity: button.parentNode.children[1].value,
        }

        library.createShopCartCard(userShopCart, cartMessage, 'dish')

        localStorage.setItem('userShopCart', JSON.stringify(userShopCart));



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
                cartMessage.innerHTML = `
                <h2>Tu carrito está vacío</h2>
                <button type="submit" value="see-more" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8">
                Seguir Comprando
                </button>
                `;
                document.querySelector('#buy').remove();
                e.target.closest('.product-quantity').classList.add('hidden');
                buyBtn = false;
            }
            else {
                cartMessage.innerHTML = ``;
            }

            library.createShopCartCard(userShopCart, cartMessage, 'dish')

            localStorage.setItem('userShopCart', JSON.stringify(userShopCart));
        }

    }
})


async function getAllDishes() {
    return await library.fetchPhp('/getAllDishes');
}

async function sendOrder(){
    const response = await library.sendDataToPhp('/addOrder', userShopCart);
    if (response.message == 'Saved') window.location.href = '/order';
    else if(response.code == 301)  window.location.href = '/login';
}
