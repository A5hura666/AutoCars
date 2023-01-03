// #9A39E8

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

const operations = document.querySelector('.operations');
operations.addEventListener('click', openoperations);


function openoperations(){
    document.querySelector('.operations-full').classList.remove('hidden')
}

const client = document.querySelector('.client');
client.addEventListener('click', openclient);

function openclient(){
    document.querySelector('.client-full').classList.remove('hidden')
}

const piece = document.querySelector('.piece');
piece.addEventListener('click', openpiece);

function openpiece(){
    document.querySelector('.pieces-full').classList.remove('hidden')
}