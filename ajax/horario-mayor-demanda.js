document.getElementById('idHorarioMayor').addEventListener("click", mostrar, true);


function mostrar(e) {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", estadoIdeal);

    xhr.open('GET', 'http://localhost/renta-bike/GestionController/horarioMayorDemanda', true);
    // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send();

    function estadoIdeal() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            let respuesta = xhr.responseText;

            let contenedor = document.getElementById('contenido');
            contenedor.innerHTML = respuesta;
            buscarHorarioMayorDemanda();
        }
    }
}

function buscarHorarioMayorDemanda() {
    var formulario = document.getElementById('formulario');
    var respuesta = document.getElementById('respuesta');
    formulario.addEventListener('submit', function(e) {
        e.preventDefault();
        //console.log("Me diste un click");
        var datos = new FormData(formulario);
        console.log(datos.get('fechaInicio'), datos.get('fechaFinal'))
        fetch("http://localhost/renta-bike/AlquilerController/mostrarFecha", {
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
                    respuesta.style.backgroundColor = '';
                    texto = 'Fecha inicio tiene que ser menor o igual a fecha final';
                    respuesta.innerHTML = texto;
                } else {
                    console.log(data.horasMayorDemanda[0]);
                    var tabla = '<br><h3>Los horarios de mayor demanda son: </h3><br> <br>';
                    tabla += '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
                    tabla += '<thead>';
                    tabla += '<tr>';
                    tabla += '<th>Hora</th>';
                    tabla += '<th>Nro de repeticiones</th>';
                    tabla += '</tr>';
                    tabla += '</thead>';
                    tabla += '<tbody>';
                    for ($i = 0; $i < data.horasMayorDemanda.length; $i++) {
                        tabla += '<tr>';
                        tabla += '<td>' + data.horasMayorDemanda[$i].horaInicioAlquiler + '</td>';
                        tabla += '<td>' + data.horasMayorDemanda[$i].conteo + '</td></tr>';
                    }
                    // tabla +='<tr> <td colspan="2"><a href="<?php echo base_url();?>/AlquilerController/generaPuntosPDF" class="btn btn-primary">PDF horas Mayor Demanda</a></td></tr>';
                    tabla += '</tbody>';
                    tabla += '</tabla>';

                    respuesta.className = 'container py-4';
                    respuesta.style.backgroundColor = 'white';
                    respuesta.innerHTML = tabla;
                }
            })
    }, true)
}