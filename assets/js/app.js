'use strict';

let formRegister = document.querySelector('#formRegister');
let popup = document.querySelector('.overlay');
let closePopUp = document.querySelector('.close');
let popUpContent = document.querySelector('.popUpContent');


formRegister.addEventListener('submit', async function(e) {

    e.preventDefault();

    let datos = new FormData(formRegister);

    // await fetch('/register/newUser', {
    await fetch('/login/checkLogin', {
            method: 'POST',
            body: datos
        })
        .then(res => res.json())
        .then(result => {

            if (result.response === true) {

                dataResult(result.data);
                popUp('visible', 1, 1);

                window.location.href = '/home/index';

            } else {
                dataResult(result.data);
                popUp('visible', 1, 1);
            }

        })
        .catch(res => {

            dataResult(res);
            popUp('visible', 1, 1);
        });

});



closePopUp.addEventListener('click', function(e) {

    e.preventDefault();

    popUp('hidden', 0, 0);

    window.location.reload();

});

function popUp(visibility, opacity, zIndex) {

    popup.style.visibility = visibility;
    popup.style.opacity = opacity;
    popup.style.zIndex = zIndex;

}

function dataResult(data) {

    let p = document.createElement('p');
    p.textContent = data;
    popUpContent.appendChild(p);
}