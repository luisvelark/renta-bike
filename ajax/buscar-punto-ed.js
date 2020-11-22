var map;

function iniciarMap() {
    var listaC = lista();
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: listaC[0]
    });
    for (let index = 0; index < listaC.length; index++) {
        var marker = new google.maps.Marker({
            position: listaC[index],
            map: map
        });
    }
}

function lista() {

    var objetos_coor = new Array();
    var lista = document.getElementsByClassName('coor');
    for (let index = 0; index < lista.length; index++) {
        var cadena = lista[index].value.split('/');
        var objeto = {
            lat: parseFloat(cadena[0]),
            lng: parseFloat(cadena[1])
        };
        objetos_coor.push(objeto);
    }
    return objetos_coor;
}