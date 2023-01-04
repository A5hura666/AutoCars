let Client

function replacefieldcli(data){
    document.querySelector(".lname").value = data.LastName
    document.querySelector(".fname").value = data.FirstName
    document.querySelector(".adress").value = data.Address
    document.querySelector(".cp").value = data.CP
    document.querySelector(".ville").value = data.City
    document.querySelector(".phone").value = data.Telephone
    document.querySelector(".email").value = data.Mail
    document.cookie = `id=${data.CodeClient}`
    let truc = fetch(`/jaux/laragon/www/AutoCars/public/classes/getVehiculeJson.php?id=${data.CodeClient}`).then((response)=> response.json()).then((data)=> replacefieldvehi(data))
}

function replacefieldvehi(data){
    document.querySelector(".brand").value = data.marque
    document.querySelector(".model").value = data.NumModele
    document.querySelector(".serialnumber").value = data.NoSerie
    document.querySelector(".immat").value = data.NoImmatriculation
    document.querySelector(".drivingdate").value = data.DateMiseEnCirculation
}



function select_client() {
    let Name = document.querySelector('.usersearchbar').value.split(' ');
    let res = fetch(`/jaux/laragon/www/AutoCars/public/classes/getOneByNameJson.php?LastName=${Name[0]}&FirstName=${Name[1]}`).then((response)=> response.json())
        .then((data)=> replacefieldcli(data))
}