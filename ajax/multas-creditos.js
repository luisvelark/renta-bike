console.write("hola");
document.getElementById('idMultasCredito').addEventListener("click", mostar, true);


function mostar(e) {

  let xhr = new XMLHttpRequest();
  xhr.addEventListener("readystatechange", estadoIdeal);

  xhr.open('GET', 'http://localhost/renta-bike/GestionController/multascredito', true);
  // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.send();

  function estadoIdeal() {
    document.write(xhr.status)
    if (xhr.readyState === 4 && xhr.status === 200) {

      let respuesta = xhr.responseText;

      let contenedor = document.getElementById('contenido');
      contenedor.innerHTML = respuesta;
    }
  }
}