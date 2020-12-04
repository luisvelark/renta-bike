document.getElementById('idPuntoRetorno').addEventListener("click", mostrar, true);


function mostrar(e) {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", estadoIdeal);

    xhr.open('GET', 'http://localhost/renta-bike/GestionController/puntosRetorno', true);
    // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send();

    function estadoIdeal() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            let respuesta = xhr.responseText;

            let contenedor = document.getElementById('contenido');
            contenedor.innerHTML = respuesta;
            buscarPuntoRetorno();
        }
    }
}

function buscarPuntoRetorno() {
    var formulario = document.getElementById('formulario');
    var respuesta = document.getElementById('respuesta');
    formulario.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log("Me diste un click");
        var datos = new FormData(formulario);
        console.log(datos.get('fechaInicio'), datos.get('fechaFinal'))
        fetch("http://localhost/renta-bike/AlquilerController/mostrarPuntoRetorno", {
                method: 'POST',
                body: datos
            })
            .then(res => res.json())
            .then(data => {
                if (data.rta === 'error') {

                    respuesta.className = 'alert alert-danger';
                    respuesta.style.backgroundColor = '';
                    texto = 'No se encuentran valores con las fechas ingresadas';
                    respuesta.innerHTML = texto;
                } else if (data.rta === 'errorFecha') {
                    respuesta.className = 'alert alert-danger';
                    texto = 'Fecha inicio tiene que ser menor o igual a fecha final';
                    respuesta.innerHTML = texto;
                } else {
                    var tabla = '<br><h3>Puntos de retorno más utilizados</h3><br> <br>';
                    tabla += '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
                    tabla += '<thead>';
                    tabla += '<tr>';
                    tabla += '<th>Dirección</th>';
                    tabla += '<th>Teléfono</th>';
                    tabla += '<th>Calificación</th>';
                    tabla += '<th>Conteo</th>';
                    tabla += '</tr>';
                    tabla += '</thead>';
                    tabla += '<tbody>';
                    for ($i = 0; $i < data.puntosRetorno.length; $i++) {
                        tabla += '<tr>';
                        tabla += '<td>' + data.puntosRetorno[$i].direccion + '</td>';
                        tabla += '<td>' + data.puntosRetorno[$i].telefono + '</td>';
                        tabla += '<td>' + data.puntosRetorno[$i].calificacionTotal + '</td>';
                        tabla += '<td>' + data.puntosRetorno[$i].conteo + '</td></tr>';
                    }
                    tabla += '</tbody>';
                    tabla += '</tabla>';
                    respuesta.className = 'container py-4';
                    respuesta.style.backgroundColor = 'white';
                    respuesta.innerHTML = tabla;
                    //console.log(data);
                    //console.log(data.puntosRetorno);

                }
            })
    }, true)
}