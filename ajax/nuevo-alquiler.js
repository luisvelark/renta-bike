//VENTANA DE NUEVO ALQUILER!
let btnAlquiler = document.getElementById("idAlquiler");
btnAlquiler.addEventListener("click", ventanaAlquiler, true);

function ventanaAlquiler(e) {
  //MOSTRAR VENTANA
  let xhr = new XMLHttpRequest();
  xhr.addEventListener("readystatechange", estadoIdeal);

  xhr.open(
    "GET",
    "http://localhost/renta-bike/GestionController/nuevoAlquiler",
    true
  );
  // xhr.setRequestHeader('Content-type', 'applicationx-www-form-urlencoded');
  xhr.send();

  function estadoIdeal() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      let respuesta = xhr.responseText;

      let contenedor = document.getElementById("contenido");
      contenedor.innerHTML = respuesta;

      envioAlquiler();
    }
  }
}

function envioAlquiler() {
  //ENVIO DE FORMULARIO ALQUILER
  let formAlquiler = document.getElementById("form-alquiler");
  formAlquiler.addEventListener("submit", enviarAlquiler, true);

  let msj = document.getElementById("respuesta");

  function enviarAlquiler(e) {
    e.preventDefault();
    console.log("envie");

    var datos = new FormData(this);

    console.log(datos);
    console.log(datos.get("punto-entrega"));
    console.log(datos.get("hora-inicio"));
    console.log(datos.get("cant-hora"));

    let url = "http://localhost/renta-bike/alquiler-nuevo";

    fetch(url, {
      method: "POST",
      body: datos,
    })
      .then((res) => res.json())
      .then((data) => {
        console.log(data);
        if (data.msg === "error") {
          msj.innerHTML = `
          <div class="alert alert-danger" role="alert">
             llena todos los campos obligatorios!
          </div>`;
        } else {
          msj.innerHTML = `
          <div class="alert alert-primary" role="alert">
            ${data.msg}
          </div>`;
        }
      });
    // .catch((err) => console.log(err));
  }
}
