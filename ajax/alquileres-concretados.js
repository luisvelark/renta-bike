document.getElementById('idAlquileres').addEventListener("click", mostrar, true);


function mostar(e) {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", estadoIdeal);

    xhr.open('GET', 'http://localhost/renta-bike/GestionController/alquileresConcretados', true);
    xhr.send();

    function estadoIdeal() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let contenedor = document.getElementById('contenido');
            let respuesta = xhr.responseText;

            contenedor.innerHTML = respuesta;

        }
    }
}