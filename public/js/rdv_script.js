let Client

function replacefieldcli(data) {
    document.querySelector(".lname").value = data.LastName
    document.querySelector(".fname").value = data.FirstName
    document.querySelector(".adress").value = data.Address
    document.querySelector(".cp").value = data.CP
    document.querySelector(".ville").value = data.City
    document.querySelector(".phone").value = data.Telephone
    document.querySelector(".email").value = data.Mail
    document.cookie = `clientid=${data.CodeClient}`
    let truc = fetch(`classes/getVehiculeJson.php?id=${data.CodeClient}`).then((response) => response.json()).then((data) => replacefieldvehi(data))
}

function replacefieldvehi(data) {
    document.querySelector(".brand").value = data.marque
    document.querySelector(".model").value = data.NumModele
    document.querySelector(".serialnumber").value = data.NoSerie
    document.querySelector(".immat").value = data.NoImmatriculation
    document.querySelector(".drivingdate").value = data.DateMiseEnCirculation
}



function select_client() {
    let Name = document.querySelector('.usersearchbar').value.split(' ');
    let res = fetch(`classes/getOneByNameJson.php?LastName=${Name[0]}&FirstName=${Name[1]}`).then((response) => response.json())
        .then((data) => replacefieldcli(data))
}

function alsoChoise(id) {
    let idnotnull
    let cook = document.cookie.split(';')
    cook.forEach(element => { if (element.includes('client')) { idnotnull = element.split('=') } })
    console.log(idnotnull)
    if (idnotnull[1] !== "") {
        fetch(`classes/getOneByIdJson.php?id=${id}`).then((response) => response.json())
            .then((data) => replacefieldcli(data))
    }

}