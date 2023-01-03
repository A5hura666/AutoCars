function select_client() {
    Name = document.querySelector('.usersearchbar').value.split(' ');
    jQuery.ajax({
        type: "POST",
        url: 'classes/ClientsDAO.php',
        dataType: 'json',
        data: {functionname: 'getOneByName', arguments: [Name[0], Name[1]]},

        success: function (obj, textstatus) {
            if( !('error' in obj) ) {
                yourVariable = obj.result;
            }
            else {
                console.log(obj.error);
            }
        }
    });
}