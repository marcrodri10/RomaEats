import * as library from "./../library/library.js";

const validationCardDate = document.querySelector('#validation_date');
console.log(validationCardDate);

validationCardDate.addEventListener('keyup', (e) => {
    console.log(e.key);

    if (e.key.match(/[0-9]+/)) {
        if (validationCardDate.value.replaceAll(/\s/g, '').length < 5) {
            validationCardDate.maxlength++;
            validationCardDate.value += e.key
        }
    }
    if (validationCardDate.value.length == 2) {
        validationCardDate.value += ' / ';
    }
})

const cardsDiv = document.querySelector('.cards');
if (cardsDiv) {
    cardsDiv.addEventListener('click', async (e) => {
        if (e.target.type == "radio") {
            const userCard = await library.sendDataToPhp('/getCard', parseInt(e.target.id))
        }
    })

}
