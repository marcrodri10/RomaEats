import * as library from "../library/library.js";

const addBtn = document.querySelectorAll('#add-recipe > *');
const recipeForm = document.querySelector('#recipe-form');
const closeModal = document.querySelectorAll('#close-modal > *');
const addRecipe = document.querySelector('#add-step');
const productsDiv = document.querySelector("#products-div");
const recipesInputs = document.querySelector('.recipes-inputs');
const addBtnDiv = document.querySelector('.btn-group');
const addProduct = document.querySelector('#add-product');
const recipeIngredients = document.querySelector('.product-selects');
let step = 1;
let addedDelete = false;
let addedSend = false;
let selectAdded = false;
let selectDiv;



const products = await library.fetchPhp('/getProducts');

addBtn.forEach(element => {
    element.addEventListener('click', (e) => {
        library.showModal(recipeForm);
        productsDiv.style.filter = 'blur(5px)';

    })


})

closeModal.forEach(element => {
    element.addEventListener('click', (e) => {
        library.hideModal(recipeForm);
        productsDiv.style.filter = 'blur(0)';
    })
})

addRecipe.addEventListener('click', (e) => {
    const divContainer = library.createElement('div', { className: 'relative mt-6 recipe-step' });
    const divAbsolute = library.createElement('div', { className: 'absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none' });
    const svgElement = library.createElement('svg', { className: 'w-4 h-4 text-gray-500 dark:text-gray-400', 'aria-hidden': 'true', xmlns: 'http://www.w3.org/2000/svg', fill: 'none', viewBox: '0 0 20 20' });
    const pathElement = library.createElement('path', { stroke: 'currentColor', 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'm19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z' });
    const inputElement = library.createElement('input', {
        type: 'search',
        id: 'search-product',
        className: 'block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50  focus:border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        placeholder: `Paso ${step}`,
        value: '',
        name: `recipe_step_${step}`,
        autocomplete: 'off',
        required: true
    });

    svgElement.appendChild(pathElement);
    divAbsolute.appendChild(svgElement);
    divContainer.appendChild(divAbsolute);
    divContainer.appendChild(inputElement);

    recipesInputs.appendChild(divContainer);
    step++;

    if (!addedDelete) {
        const deleteBtnDiv = document.createElement('div');
        deleteBtnDiv.classList.add('button-icon', 'flex', 'justify-around');

        deleteBtnDiv.innerHTML = `
    <button id="delete-btn" type="button" value="delete" class="ms-3 bg-green-700 pt-3 pb-3 pl-7 pr-7 justify-center mt-8 modal inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
        Eliminar paso
        <img src="img/add.svg" alt="add-icon" class="w-6">
    </button>

    `;
        addBtnDiv.appendChild(deleteBtnDiv);

        const sendBtnDiv = document.createElement('div');
        sendBtnDiv.classList.add('button-icon', 'flex', 'justify-around');

        sendBtnDiv.innerHTML = `
        <button id="send-btn" type="submit" value="delete" class="ms-3 bg-green-700 pt-3 pb-3 pl-7 pr-7 justify-center mt-8 modal inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-800 dark:hover:bg-white  active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
        Guardar
        </button>`;

        addBtnDiv.appendChild(sendBtnDiv);

        const deleteBtn = deleteBtnDiv.querySelector('#delete-btn');

        deleteBtn.addEventListener('click', () => {
            console.log('hola');

            const lastStep = document.querySelector('.recipe-step:last-child');
            if (lastStep != null) {
                lastStep.remove();
                step--;
                if (document.querySelectorAll('.recipe-step').length == 0) {
                    addBtnDiv.children[3].remove();
                    addBtnDiv.children[2].remove();
                    addedDelete = false;
                    step = 1;
                    console.log('se resetea');
                }
            }


        });
        addedDelete = true;
    }



})

addProduct.addEventListener('click', () => {

    console.log(recipeIngredients);
    const select = document.createElement('select');
    select.id = 'ingredients';
    select.name = 'ingredients';
    select.className = "class= mb-6 block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50  focus:border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500";
    recipeIngredients.appendChild(select);

    for (let product in products) {
        const option = document.createElement('option');
        option.value = products[product].user_product_id;
        option.textContent = products[product].user_product_name;
        select.appendChild(option);
        console.log(products[product]);
    }

})
