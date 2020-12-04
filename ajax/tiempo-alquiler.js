document.getElementById('idTiempoAlquiler').addEventListener("click", mostrar, true);


function mostrar(e) {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", estadoIdeal);

    xhr.open('GET', 'http://localhost/renta-bike/GestionController/tiempoAlquiler', true);
    // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send();

    function estadoIdeal() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            let respuesta = xhr.responseText;

            let contenedor = document.getElementById('contenido');
            contenedor.innerHTML = respuesta;
            tiempoAlquilerRepetido();
        }
    }
}

function tiempoAlquilerRepetido() {
    var formulario = document.getElementById('formulario');
    var respuesta = document.getElementById('respuesta');
    formulario.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log("Me diste un click");
        var datos = new FormData(formulario);
        console.log(datos.get('fechaInicio'), datos.get('fechaFinal'))
        fetch("http://localhost/renta-bike/AlquilerController/mostrarTiempoAlquiler", {
                method: 'POST',
                body: datos
            })
            .then(res => res.json())
            .then(data => {
                if (data.rta === 'error') {
                    respuesta.className = 'alert alert-danger';
                    texto = 'No se encuentran valores con las fechas ingresadas';
                    respuesta.innerHTML = texto;
                } else if (data.rta === 'errorFecha') {
                    respuesta.className = 'alert alert-danger';
                    texto = 'Fecha inicio tiene que ser menor o igual a fecha final';
                    respuesta.innerHTML = texto;
                } else {
                    console.log(data);
                    console.log(typeof data.tiempoAlquiler[0].resta);
                    $2 = 0;
                    $3 = 0;
                    $4 = 0;
                    $5 = 0;
                    $6 = 0;
                    for ($i = 0; $i < data.tiempoAlquiler.length; $i++) {
                        switch (data.tiempoAlquiler[$i].resta.slice(0, 1)) {
                            case '2':
                                $2 += 1;
                                break;
                            case '3':
                                $3 += 1;
                                break;
                            case '4':
                                $4 += 1;
                                break;
                            case '5':
                                $5 += 1;
                                break;
                            case '6':
                                $6 += 1;
                                break;
                        }
                    }
                    if ($2 > $3) {
                        if ($2 > $4) {
                            if ($2 > $5) {
                                if ($2 > $6) {
                                    text = '<br><h3>El tiempo de alquiler más utilizado es: 2hs.';
                                }
                            }
                        }
                    } else if ($3 > $4) {
                        if ($3 > $5) {
                            if ($3 > $6) {
                                text = '<br><h3>El tiempo de alquiler más utilizado es: 3hs.';
                            }
                        }
                    } else if ($4 > $5) {
                        if ($4 > $6) {
                            text = '<br><h3>El tiempo de alquiler más utilizado es: 4hs.';
                        }
                    } else if ($5 > $6) {
                        text = '<br><h3>El tiempo de alquiler más utilizado es: 5hs.';
                    } else {
                        text = '<br><h3>El tiempo de alquiler más utilizado es: 6hs.';
                    }
                    console.log($2, $3, $4, $5, $6);
                    respuesta.className = 'container py-4';
                    respuesta.style.backgroundColor = 'white';
                    respuesta.innerHTML = text;
                }
            })
    }, true)
}