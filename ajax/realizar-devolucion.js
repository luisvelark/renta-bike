//VENTANA DE REALIZAR DEVOLUCION!
let btn = document.getElementById("idRealizarDevolucion");
btn.addEventListener("click", ventanaDevolucion, true);

function ventanaDevolucion(e) {
  //MOSTRAR VENTANA
  let xhr = new XMLHttpRequest();
  xhr.addEventListener("readystatechange", estadoIdeal);

  xhr.open(
    "GET",
    "http://localhost/renta-bike/GestionController/realizarDevolucion",
    true
  );
  // xhr.setRequestHeader('Content-type', 'applicationx-www-form-urlencoded');
  xhr.send();

  function estadoIdeal() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      let respuesta = xhr.responseText;

      let contenedor = document.getElementById("contenido");
      contenedor.innerHTML = respuesta;
    }
  }
}
