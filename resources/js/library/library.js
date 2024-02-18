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
