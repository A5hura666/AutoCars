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
//On ajoute un évènement de click sur la fonction d'ouverture de RDV.
const rdv = document.querySelector('.rdv');
rdv.addEventListener('click', openrdv);

//Fonction d'ouverture de détails RDV.
function openrdv(){
    document.querySelector('.rdv-full').classList.remove('hidden')
}
//On ajoute un évènement de click sur la fonction d'ouverture de client.
const client = document.querySelector('.client');
client.addEventListener('click', openclient);

//Fonction d'ouverture de détails clients.
function openclient(){
    document.querySelector('.client-full').classList.remove('hidden')
}
