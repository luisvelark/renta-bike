document.getElementById('idMultasCredito').addEventListener("click", mostrar, true);


function mostrar(e) {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", estadoIdeal);
    xhr.open('GET', 'http://localhost/renta-bike/GestionController/multascredito', true);
    xhr.send();

    function estadoIdeal() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            let respuesta = xhr.responseText;

            let contenedor = document.getElementById('contenido');
            contenedor.innerHTML = respuesta;
            buscarCliente();
        }
    }
}

function buscarCliente() {
    var formulario = document.getElementById('formulario');
    var respuesta = document.getElementById('respuesta');
    formulario.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log("Me diste un click");
        var datos = new FormData(formulario);
        console.log(typeof datos.get('dniCliente'))
        fetch("http://localhost/renta-bike/ClienteController/mostrarCliente", {
                method: 'POST',
                body: datos
            })
            .then(res => res.json())
            .then(data => {
                if (data.rta === 'errorBase') {
                    respuesta.className = 'alert alert-danger';
                    respuesta.style.backgroundColor = '';
                    texto = '¡El dni ingresado no se encuentra registrado!';
                    respuesta.innerHTML = texto;
                } else if (data.rta === 'errorLongitud') {
                    respuesta.className = 'alert alert-danger';
                    respuesta.style.backgroundColor = '';
                    texto = '¡El dni tiene que tener 8 dígitos!';
                    respuesta.innerHTML = texto;
                } else {
                    console.log(data)
                    var tabla = '<h3> Cliente: ' + data.usuario.nombre + ' ' + data.usuario.apellido + '</h3> <br> <h4> Su crédito actual es: ' + data.multaCredito.credito + '</h4><br>';
                    tabla += '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
                    tabla += '<thead>';
                    tabla += '<tr>';
                    tabla += '<th>Fecha de multa</th>';
                    tabla += '<th>Detalle</th>';
                    tabla += '<th>$ Monto</th>';
                    tabla += '<th>Pagado</th>';
                    tabla += '</tr>';
                    tabla += '</thead>';
                    tabla += '<tbody>';
                    for ($i = 0; $i < data.multaCredito.multas.length; $i++) {
                        tabla += '<tr>';
                        tabla += '<td>' + data.multaCredito.multas[$i].fechaMulta + '</td>';
                        tabla += '<td>' + data.multaCredito.multas[$i].detalleMulta + '</td>';
                        tabla += '<td class="text-right">$' + data.multaCredito.multas[$i].monto + '</td>';
                        if (data.multaCredito.multas[$i].pagado == '1') {
                            tabla += '<td>Pagado</td></tr>';
                        } else {
                            tabla += '<td>No pagado</td></tr>';
                        }

                    }
                    tabla += '</tbody>';
                    tabla += '</tabla>';
                    respuesta.className = 'container py-4';
                    respuesta.style.backgroundColor = 'white';
                    respuesta.innerHTML = tabla;
                }
            })
    }, true)
}