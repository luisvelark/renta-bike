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
    formulario.addEventListener('submit',function(e){
        e.preventDefault();
        //console.log("Me diste un click");
        var datos =new FormData(formulario);
        console.log(datos.get('fechaInicio'),datos.get('fechaFinal'))
        fetch("http://localhost/renta-bike/AlquilerController/mostrarFecha",{
            method: 'POST',
            body: datos
        })
            .then( res => res.json())
            .then( data => {
                if (data === 'error'){
                    respuesta.innerHTML=data;
                }
                else{
                    console.log(data.horasMayorDemanda[0]);
                    var tabla='<br><h3>Los horarios de mayor demanda son:<br> <br>';
                    tabla +='<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
                    tabla +='<thead>';
                    tabla +='<tr>';
                    tabla +='<th>Hora</th>';
                    tabla +='<th>Nro de repeticiones</th>';
                    tabla +='</tr>';
                    tabla +='</thead>';
                    tabla +='<tbody>';
                    for ($i = 0; $i < data.horasMayorDemanda.length; $i++){
                        tabla +='<tr>';
                        tabla +='<td>'+data.horasMayorDemanda[$i].horaInicioAlquiler+'</td>';
                        tabla +='<td>'+data.horasMayorDemanda[$i].conteo+'</td>';
                    }
                    tabla +='</tbody>';
                    tabla +='</tabla>';
                    respuesta.innerHTML=tabla;
            }
            })
    },true)
}