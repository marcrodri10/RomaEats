import * as library from "../library/library.js";

const addBtn = document.querySelectorAll('#add-recipe > *');
const recipeForm = document.querySelector('#recipe-form');
const closeModal = document.querySelectorAll('#close-modal > *');
const addRecipe = document.querySelector('#add-step');
const productsDiv = document.querySelector("#products-div");
const recipesInputs = document.querySelector('.recipes-inputs');
const addBtnDiv = document.querySelector('.btn-group');

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


