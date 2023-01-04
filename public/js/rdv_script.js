function select_client() {
    let Name = document.querySelector('.usersearchbar').value.split(' ');
    let res = fetch(`/jaux/laragon/www/AutoCars/public/classes/getOneByNameJson.php?LastName=${Name[0]}&FirstName=${Name[1]}`).then((response)=> response.json())
        .then((data)=> console.log(data));
}