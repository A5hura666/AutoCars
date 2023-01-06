const alert = document.querySelector('.alert');
if (alert) {
    setTimeout(() => {
        alert.parentElement.removeChild(alert);
    }, 3000);
}
