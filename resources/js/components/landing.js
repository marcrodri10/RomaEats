const button = document.querySelector('#landing-collapse');
const menu = document.getElementById('navbar-sticky');

button.addEventListener('click', () => {
    console.log('sii');
    const expanded = button.getAttribute('aria-expanded') === 'true' || false;
    button.setAttribute('aria-expanded', !expanded);
    menu.classList.toggle('hidden');

    if (!expanded) {
        menu.style.width = "100%";
    } else {
        menu.style.width = "";
    }
});

// Función para mostrar el modal
function showModal() {
    var modal = document.getElementById('shopping-cart-modal');
    modal.classList.remove('hidden');
    modal.setAttribute('aria-hidden', 'false'); // Evita el desplazamiento de fondo cuando el modal está abierto
}

// Función para ocultar el modal
function hideModal() {
    var modal = document.getElementById('shopping-cart-modal');
    modal.classList.add('hidden');
    modal.setAttribute('aria-hidden', 'true'); // Permite el desplazamiento de fondo cuando el modal está cerrado
}

// Agregar evento de clic para mostrar el modal
console.log(document.querySelector('#shopping-cart'));
document.querySelector('#shopping-cart').addEventListener('click', () => {
    console.log('hola');
    showModal();
})


document.querySelector('#close-shopping-cart').addEventListener('click', () => {
    hideModal();
})
