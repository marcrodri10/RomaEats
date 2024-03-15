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
            console.log(userCard.response);
            if(Object.entries(userCard.response).length > 0) {
                document.querySelector('#card').value = userCard.response.card_number;
                document.querySelector('#validation_date').value = userCard.response.validation_date;
                document.querySelector('#card_name').value = userCard.response.card_name;
                console.log(document.querySelector('#save_card'));
                document.querySelector('#save_card').checked = true;
            }
        }
    })

}
