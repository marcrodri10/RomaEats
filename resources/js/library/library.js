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
export function hideModal(element){
    element.classList.add('hidden');

}

export function showModal(element){
    element.classList.remove('hidden');

}

export async function fetchPhp(route){
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

export async function sendDataToPhp(route, data){
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

export function checkJSON(data){

    if(data == null) return false
    else if(Object.entries(data).length == 0) return false;

    return true;
}

export function generatePublicPath(){
    const path = new URL(window.location.href).pathname
    const numSlashes = path.split('/').length - 1;
    console.log(numSlashes);
    let publicPath = "";
    for(let i = 1; i < numSlashes; i++){
        publicPath += '../';
    }
    return publicPath;
}

export function createShopCartCard(shopCart, div){
    for (let cart in shopCart) {
        const publicPath = generatePublicPath();
        const { id, name, price, quantity } = shopCart[cart];
        const productCartCard = createElement('div', { className: 'flex w-90 justify-around items-center gap-3 product-cart-card' });
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
