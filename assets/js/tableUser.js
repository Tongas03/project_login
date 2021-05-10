'use strict';

let divTable = document.querySelector('.divTable');

if (document.readyState === 'loading') {

    document.addEventListener('DOMContentLoaded', init);

    divTable.addEventListener('click', function(e) {

        let id;

        switch (e.target.className) {
            case 'fas fa-edit':
                id = e.target.parentElement.parentElement.parentElement.firstElementChild.innerHTML;
                editCard(id);
                updateUser();
                break;
            case 'fas fa-trash':
                id = e.target.parentElement.parentElement.parentElement.firstElementChild.innerHTML;
                deleteUser(id);
                break;
        }
    });

}

function init() {
    tableUser();
}

function tableUser() {

    fetch('/user/getAllUsers', {
            method: 'POST'
        })
        .then(res => res.json())
        .then(result => {
            fillTable(result.data);
        })
        .catch(res => {
            console.log(res);
        });
}

function fillTable(users) {

    let table = createTable();

    let tBody = document.createElement('tbody');

    users.forEach((user) => {

        let tr = document.createElement('tr');

        user.forEach((data) => {

            let td = document.createElement('td');
            td.textContent = data;
            tr.appendChild(td);

        });

        tr.appendChild(createActions());
        tBody.appendChild(tr);

    });

    table.appendChild(tBody);
    divTable.appendChild(table);

}

function createTable() {

    let table = document.createElement('table');
    let tHead = document.createElement('thead');

    tHead.appendChild(createTr(['ID', 'NOMBRE', 'APELLIDO', 'EMAIL', 'ACCIONES']));

    table.appendChild(tHead);

    return table;
}

function createTr(data) {

    let tr = document.createElement('tr');

    for (let i = 0; i <= (data.length) - 1; i++) {

        let th = document.createElement('th');

        th.textContent = data[i];

        tr.appendChild(th);
    };

    return tr;
}

function createActions() {
    let td = document.createElement('td');

    let span1 = document.createElement('span');
    let span2 = document.createElement('span');

    let a1 = document.createElement('a');
    let a2 = document.createElement('a');

    a1.setAttribute('href', '#');
    a2.setAttribute('href', '#');

    span1.setAttribute('class', 'fas fa-edit');
    span2.setAttribute('class', 'fas fa-trash');

    a1.appendChild(span1);
    a2.appendChild(span2);

    td.appendChild(a1);
    td.appendChild(a2);

    return td;
}

function editCard(id) {

    let data = new FormData();

    data.append('id', id);

    fetch('/user/getUser', {
            method: 'POST',
            body: data
        })
        .then(res => res.json())
        .then(result => {
            fillCard(result.data)
        })
        .catch(res => {
            console.log(res);
        });

}

function fillCard(data) {

    let id = document.querySelector('#id');
    let name = document.querySelector('#name');
    let surname = document.querySelector('#surname');
    let email = document.querySelector('#email');


    id.setAttribute('value', data.id);
    name.setAttribute('value', data.name);
    surname.setAttribute('value', data.surname);
    email.setAttribute('value', data.email);

    popupCard('visible', 1, 1);
}

function updateUser() {

    let formUpdater = document.querySelector('#formUpdater');

    formUpdater.addEventListener('submit', function(e) {

        e.preventDefault();
        let data = new FormData(formUpdater);

        fetch('/user/updateUser', {
                method: 'POST',
                body: data
            })
            .then(res => res.json())
            .then(result => {
                dataResult(result.data);
                popupCard('hidden', 0, 0);
                popUp('visible', 1, 1);
            })
            .catch(res => {
                console.log(res);
            });

    });
}

function deleteUser(id) {
    let data = new FormData();

    data.append('id', id);

    fetch('/user/downUser', {
            method: 'POST',
            body: data
        })
        .then(res => res.json())
        .then(result => {
            dataResult(result.data);
            popUp('visible', 1, 1);
        })
        .catch(res => {
            console.log(res);
        });
}

function popupCard(visibility, opacity, zIndex) {

    let cardProfile = document.querySelector('#cardOverlay');
    let closeCardProfile = document.querySelector('.cardProfile .close');

    cardProfile.style.visibility = visibility;
    cardProfile.style.opacity = opacity;
    cardProfile.style.zIndex = zIndex;

    closeCardProfile.addEventListener('click', function(e) {

        e.preventDefault();

        popupCard('hidden', 0, 0);

    });

}

function popUp(visibility, opacity, zIndex) {

    let popup = document.querySelector('#popUpOverlay');
    let closePopUp = document.querySelector('.popUp .close');

    popup.style.visibility = visibility;
    popup.style.opacity = opacity;
    popup.style.zIndex = zIndex;

    closePopUp.addEventListener('click', function(e) {

        e.preventDefault();

        popUp('hidden', 0, 0);

        window.location = '/user/index';

    });

}

function dataResult(data) {

    let popUpContent = document.querySelector('.popUpContent');

    let p = document.createElement('p');
    p.textContent = data;
    popUpContent.appendChild(p);
}