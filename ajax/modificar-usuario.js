document.getElementById('idModificarPerfil').addEventListener("click", mostrar, true);


function mostrar(e) {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", estadoIdeal);

    xhr.open('GET', 'http://localhost/renta-bike/GestionController/modificarUsuario', true);
    xhr.send();

    function estadoIdeal() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let contenedor = document.getElementById('contenido');
            let respuesta = xhr.responseText;
            contenedor.innerHTML = respuesta;
            actualizarUsuario();
        }
    }
}

function actualizarUsuario() {
    var formulario = document.getElementById('idFormModificar');
    var respuesta = document.getElementById('divRespuesta');
    formulario.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log("Me diste un click");
        var datos = new FormData(formulario);
        (datos.get('nombre'),
            datos.get('apellido'),
            datos.get('dni'),
            datos.get('cuil'),
            datos.get('domicilio'),
            datos.get('fecha'),
            datos.get('telefono'),
            datos.get('correo'),
            datos.get('contraseña'),
            datos.get('rcontraseña'))
        fetch('http://localhost/renta-bike/UsuarioController/actualizarUsuario', {
                method: 'POST',
                body: datos
            })
            .then(res => res.json())
            .then(data => {

                if (data.ok === 'Se modificaron los datos correctamente. Vuelva a iniciar sesión para que no haya inconvenientes') {

                    respuesta.className = 'alert alert-success';
                    respuesta.innerHTML = data.ok;

                } else {
                    respuesta.className = 'alert alert-danger';
                    respuesta.innerHTML = data.ok;
                }


            })
    }, true)
}