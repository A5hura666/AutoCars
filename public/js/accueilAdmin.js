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


const operation = document.querySelector('.operation');
operation.addEventListener('click', openoperation);

function openoperation(){
    document.querySelector('.operation-full').classList.remove('hidden')
}
