const alert = document.querySelector('.alert');
//Gestion des alertes.
if (alert) {
    setTimeout(() => {
        alert.parentElement.removeChild(alert);
    }, 3000);
}
