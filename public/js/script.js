const back = document.querySelectorAll('.back');
const modal = document.querySelectorAll('.popupmenu');

//On ajoute un événement de click sur la fermeture de détails.
for(let i = 0; i < back.length; i++) {
    back[i].addEventListener('click', remove);
}

//Fonction de fermeture de détails.
function remove() {
    for(let i = 0; i < modal.length; i++) {
        modal[i].classList.add('hidden')
    }
}
//On ajoute un événement de click sur l'ouverture de détails RDV.
const rdv = document.querySelector('.rdv');
rdv.addEventListener('click', openrdv);

//Fonction d'ouverture de détails RDV.
function openrdv(){
    document.querySelector('.rdv-full').classList.remove('hidden')
}

//On ajoute un événement de click sur l'ouverture de détails client.
const client = document.querySelector('.client');
client.addEventListener('click', openclient);

//Fonction d'ouverture de détails client.
function openclient(){
    document.querySelector('.client-full').classList.remove('hidden')
}

//On ajoute un événement de click sur l'ouverture de détails facture.
const facture = document.querySelector('.facture');
facture.addEventListener('click', openfacture);

//Fonction d'ouverture de détails facture.
function openfacture(){
    document.querySelector('.facture-full').classList.remove('hidden')
}

//On ajoute un événement de click sur l'ouverture de détails pièce.
const piece = document.querySelector('.piece');
piece.addEventListener('click', openpiece);

//Fonction d'ouverture de détails pièce.
function openpiece(){
    document.querySelector('.pieces-full').classList.remove('hidden')
}
document.querySelector('bouton').addEventListener('click',f(1,'devis',false));

function f(id,type,bool) {
    console.log(id)
    console.log(type)
    console.log(bool)
    let res = fetch(`../factureCalcul.php?function=calculCost?id=${id}?type=${type}?bool=${bool}`).then((response) => response.json()).then((data))

}