console.log("hola");
document.getElementById('idAlquiler').addEventListener("click", mostar, true);


function mostar(e) {

  let xhr = new XMLHttpRequest();
  xhr.addEventListener("readystatechange", estadoIdeal);

  xhr.open('GET', 'http://localhost/renta-bike/GestionController/alquiler', true);
  // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.send();

  function estadoIdeal() {
    if (xhr.readyState === 4 && xhr.status === 200) {

      let respuesta = xhr.responseText;

      let contenedor = document.getElementById('contenido');
      contenedor.innerHTML = respuesta;
    }
  }
}