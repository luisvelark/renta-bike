document.getElementById('idBajaUsuario').addEventListener("click", mostrar, true);


function mostrar(e) {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", estadoIdeal);

    xhr.open('GET', 'http://localhost/renta-bike/GestionController/bajaUsuario', true);
    xhr.send();

    function estadoIdeal() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let contenedor = document.getElementById('contenido');
            let respuesta = xhr.responseText;
            contenedor.innerHTML = respuesta;
            bajaUsuario();
        }
    }
}

function bajaUsuario() {
    var formulario = document.getElementById('formBaja');
    var respuesta = document.getElementById('divRespuestaBaja');
    formulario.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log("Me diste un click");
        var datos = new FormData(formulario);
        (datos.get('correo'),
            datos.get('contraseña'))
        fetch('http://localhost/renta-bike/UsuarioController/bajaUsuario', {
                method: 'POST',
                body: datos
            })
            .then(res => res.json())
            .then(data => {
                if (data.ok === 'Los datos ingresados no coinciden') {
                    respuesta.className = 'alert alert-danger';
                    respuesta.innerHTML = data.ok;
                } else if (data.ok === 'Tiene multa/s no pagada/s. Acercate a un punto de entrega') {
                    respuesta.className = 'alert alert-danger';
                    respuesta.innerHTML = data.ok;

                } else if (data.ok === 'No se puede dar de baja. Tiene un alquiler activo') {
                    respuesta.className = 'alert alert-danger';
                    respuesta.innerHTML = data.ok;


                } else if (data.ok === 'No se puede dar de baja. Tiene un alquiler en proceso') {
                    respuesta.className = 'alert alert-danger';
                    respuesta.innerHTML = data.ok;


                } else {
                    location.href = "http://localhost/renta-bike/?exit=1";
                }
            })
    }, true)
}