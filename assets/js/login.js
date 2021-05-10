'use strict';

let form = document.querySelector('form');
let popup = document.querySelector('#popUpOverlay');
let closePopUp = document.querySelector('.popUp .close');
let popUpContent = document.querySelector('.popUpContent');

if (document.readyState === 'loading') {

    document.addEventListener('DOMContentLoaded', init);

} else {

    init();
}

function init() {


    form.addEventListener('submit', async function(e) {

        e.preventDefault();

        let datos = new FormData(form);
        let url;

        if (form.getAttribute('id') == 'formLogin') {
            url = '/login/checkLogin';
        } else {
            url = '/register/newUser';
        }

        await fetch(url, {
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
}

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