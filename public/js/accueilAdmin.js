const back = document.querySelectorAll('.back');
const modal = document.querySelectorAll('.popupmenu');

//On ajoute l'événement de click à la fonction de retrait.
for(let i = 0; i < back.length; i++) {
    back[i].addEventListener('click', remove);
}

//Fonction de fermeture de détails.
function remove() {
    for(let i = 0; i < modal.length; i++) {
        modal[i].classList.add('hidden')
    }
}

//On ajoute l'événement de click à la fonction d'ouverture de détails.
const operation = document.querySelector('.operation');
operation.addEventListener('click', openoperation);

//Fonction d'ouverture de détails.
function openoperation(){
    document.querySelector('.operation-full').classList.remove('hidden')
}
