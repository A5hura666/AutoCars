const back = document.querySelectorAll('.back');
const modal = document.querySelectorAll('.popupmenu');

//On ajoute un évènement de click sur la fonction de fermeture.
for(let i = 0; i < back.length; i++) {
    back[i].addEventListener('click', remove);
}
//Fonction de fermeture de détails.
function remove() {
    for(let i = 0; i < modal.length; i++) {
        modal[i].classList.add('hidden')
    }
}
//On ajoute un évènement de click sur la fonction d'ouverture de client.
const client = document.querySelector('.client');
client.addEventListener('click', openclient);
//Fonction d'ouverture de détails client.
function openclient(){
    document.querySelector('.client-full').classList.remove('hidden')
}
//On ajoute un évènement de click sur la fonction d'ouverture de pièces.
const piece = document.querySelector('.piece');
piece.addEventListener('click', openpiece);
//Fonction d'ouverture de détails pièces.
function openpiece(){
    document.querySelector('.pieces-full').classList.remove('hidden')
}