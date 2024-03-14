// Función para mostrar el modal
/* function showModal() {
    var modal = document.getElementById('shopping-cart-modal');
    modal.classList.remove('hidden');
    modal.setAttribute('aria-hidden', 'false'); // Evita el desplazamiento de fondo cuando el modal está abierto
} */

// Función para ocultar el modal
/* function hideModal() {
    var modal = document.getElementById('shopping-cart-modal');
    modal.classList.add('hidden');
    modal.setAttribute('aria-hidden', 'true'); // Permite el desplazamiento de fondo cuando el modal está cerrado
} */

// Agregar evento de clic para mostrar el modal
export function hideModal(element) {
    element.classList.add('hidden');

}

export function showModal(element) {
    element.classList.remove('hidden');

}

export async function fetchPhp(route) {
    let fetchOptions = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    }
    try {
        const response = await fetch(route, fetchOptions);
        if (response.ok) {
            const data = await response.json();
            return data;
        } else {
            throw new Error('Error en la solicitud');
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

export async function sendDataToPhp(route, data) {
    let fetchOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    };

    try {
        const response = await fetch(route, fetchOptions);

        if (response.ok) {
            const data = await response.json();
            return data;
        } else {
            throw new Error('Error en la solicitud');
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

export function createElement(tag, attributes = {}) {
    const element = document.createElement(tag);
    Object.assign(element, attributes);
    return element;
}

export function checkJSON(data) {

    if (data == null) return false
    else if (Object.entries(data).length == 0) return false;

    return true;
}

export function generatePublicPath() {
    const path = new URL(window.location.href).pathname
    const numSlashes = path.split('/').length - 1;
    let publicPath = "";
    for (let i = 1; i < numSlashes; i++) {
        publicPath += '../';
    }
    return publicPath;
}

export function createShopCartCard(shopCart, div) {
    for (let cart in shopCart) {
        if (shopCart[cart].hasOwnProperty('img')) {
            const { id, name, quantity, price, img } = shopCart[cart];
            const productCartCard = createElement('div', { className: 'flex w-90 justify-around items-center gap-3 product-cart-card' });
            productCartCard.innerHTML = `
                    <div class="w-40">
                        <img src="${img}">
                    </div>
                    <div class="flex-col w-40">
                        <p>${name}</p>
                        <p>${price}</p>
                        <p>${quantity}</p>
                    </div>
                `;
            div.appendChild(productCartCard);


        }
        else {
            const publicPath = generatePublicPath();
            const { id, name, price, quantity } = shopCart[cart];
            const productCartCard = createElement('div', { className: 'flex w-90 justify-around items-center gap-3 product-cart-card' });
            console.log(`${publicPath}img/dish${id}.png`);
            productCartCard.innerHTML = `
            <div class="w-40">
                <img src="${publicPath}img/dish${id}.png">
            </div>
            <div class="flex-col w-40">
                <p>${name}</p>
                <p>${price}</p>
                <p>${quantity}</p>
            </div>
        `;
            div.appendChild(productCartCard);

        }


    }
}
export function createProductShopCartCard(shopCart, div) {

    for (let cart in shopCart) {
        const { id, name, quantity, img } = shopCart[cart];
        const productCartCard = createElement('div', { className: 'flex w-90 justify-around items-center gap-3 product-cart-card' });
        productCartCard.innerHTML = `
            <div class="w-40">
                <img src="${img}">
            </div>
            <div class="flex-col w-40">
                <p>${name}</p>
                <p>${quantity}</p>
            </div>
        `;
        div.appendChild(productCartCard);

    }
}

export function generateDishCard(div, dish) {
    div.innerHTML += `

<div class="bg-white flex-grow-1 border flex-grow-1 border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 food-dish mt-5" id="product${dish.dish_id}">
<a href="/dish/${dish.dish_id}">
    <div class="w-100 h-50">
    <img src="img/${dish.dish_image}" alt="dish" class="w-100 h-100 dish-image">
    </div>
    <div class="dish-info p-3 flex flex-col h-25 justify-between">
    <div class="h-1/4">
        <h2 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            ${dish.dish_name}</h2>
    </div>

    <div class="h-1/4 flex items-center ">
        <p class=" font-normal text-gray-700 dark:text-gray-400">${dish.dish_price}€</p>
    </div>
    </div>
</a >
<div class="flex justify-evenly items-center h-25 buttons">
    <button id="add" value="add" type = 'submit', class = 'ms-3 bg-green-700 pt-3 pb-3 pl-8 pr-8 flex justify-center, items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    Añadir
    </button>

    <div class="hidden product-quantity">
    <div class="relative flex items-center incrementor">
        <button type="button" id="decrement-button" data-input-counter-decrement="counter-input"
            class="flex-shrink-0 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
            <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 18 2">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h16" />
            </svg>
        </button>
        <input type="text" id="counter-input" data-input-counter
            class="flex-shrink-0 text-gray-900 dark:text-white border-0 bg-transparent text-sm font-normal focus:outline-none focus:ring-0 max-w-[2.5rem] text-center"
            placeholder="" value="1" required min="0"/>
        <button type="button" id="increment-button" data-input-counter-increment="counter-input"
            class="flex-shrink-0 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
            <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 1v16M1 9h16" />
            </svg>
        </button>
    </div>
</div>
</div>
</div>`;
}
