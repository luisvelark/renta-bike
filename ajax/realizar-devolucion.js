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
  var formulario = document.getElementById("form-devolucion");
  var respuesta = document.getElementById("respuesta");
  formulario.addEventListener(
    "submit",
    function (e) {
      e.preventDefault();
      console.log("Me diste un click");
      var datos = new FormData(formulario);
      console.log(
        datos.get("ruta"),
        datos.get("daño"),
        datos.get("punto-entrega")
      );
      fetch(
        "http://localhost/renta-bike/AlquilerController/realizarDevolucion",
        {
          method: "POST",
          body: datos,
        }
      )
        .then((res) => res.json())
        .then((data) => {
          respuesta.style.display = "block";
          if (data.rta === "ingresoDatos") {
            respuesta.className = "alert alert-danger w-50 text-center";
            // respuesta.style.backgroundColor = "red";
            $texto = "Por favor complete los campos obligatorios!";
            respuesta.innerHTML = $texto;
          } else if (data.rta === "suspendido") {
            location.href = "http://localhost/renta-bike/?estaSuspendido=1";
          } else {
            respuesta.className = "alert alert-success w-50 text-center";
            // respuesta.style.backgroundColor = "white";
            $texto =
              "La devolución se realizo con exito...gracias por elegirnos!";
            respuesta.innerHTML = $texto;
          }
          setTimeout(() => {
            respuesta.style.display = "none";
          }, 6000);
        });
    },
    true
  );
}
