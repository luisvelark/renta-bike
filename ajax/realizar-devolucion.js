//VENTANA DE REALIZAR DEVOLUCION!

btn = document.getElementById("idRealizarDevolucion");
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
            realizaDevolucion();
        }
    }
}

function realizaDevolucion() {
  var formulario = document.getElementById('form-devolucion');
  var respuesta = document.getElementById('respuesta');
  formulario.addEventListener('submit', function(e) {
      e.preventDefault();
      console.log("Me diste un click");
      var datos = new FormData(formulario);
      console.log(datos.get('ruta'), datos.get('daño'), datos.get('punto-entrega'))
      fetch("http://localhost/renta-bike/AlquilerController/realizarDevolucion", {
              method: 'POST',
              body: datos
          })
          .then(res => res.json())
          .then(data => {
            if (data.rta === 'ingresoDatos') {
              respuesta.className = 'alert alert-danger';
              respuesta.style.backgroundColor = 'red';
              $texto = 'Por favor complete los campos obligatorios';
              respuesta.innerHTML = $texto;
          } 
          else{
            respuesta.className = 'container py-4';
            respuesta.style.backgroundColor = 'white';
            $texto = 'Ta todo bien p='+typeof data.puntaje+' cM='+data.cantMulta;
            respuesta.innerHTML = $texto;
          }
          })
  }, true)
}