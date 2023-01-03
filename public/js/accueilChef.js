const back = document.querySelectorAll('.back');
const modal = document.querySelectorAll('.popupmenu');


for(let i = 0; i < back.length; i++) {
    back[i].addEventListener('click', remove);
}

function remove() {
    for(let i = 0; i < modal.length; i++) {
        modal[i].classList.add('hidden')
    }
}

const rdv = document.querySelector('.rdv');
rdv.addEventListener('click', openrdv);


function openrdv(){
    document.querySelector('.rdv-full').classList.remove('hidden')
}

const client = document.querySelector('.client');
client.addEventListener('click', openclient);

function openclient(){
    document.querySelector('.client-full').classList.remove('hidden')
}

const facture = document.querySelector('.facture');
facture.addEventListener('click', openfacture);

function openfacture(){
    document.querySelector('.facture-full').classList.remove('hidden')
}

const piece = document.querySelector('.piece');
piece.addEventListener('click', openpiece);

function openpiece(){
    document.querySelector('.pieces-full').classList.remove('hidden')
}