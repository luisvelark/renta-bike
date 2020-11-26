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

  let editar = document.getElementById("idEditar");
  editar.addEventListener("click", editarAlquiler, true);

  let msj = document.getElementById("respuesta");
  let detalle = document.getElementById("detalles");
  let enviar = document.getElementById("idEnviar");
  let campos = document.getElementById("idCampos");

  function editarAlquiler() {
    campos.disabled = false;
    enviar.disabled = false;
    editar.disabled = true;
  }

  function enviarAlquiler(e) {
    e.preventDefault();
    console.log("envie");

    var datos = new FormData(this);

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
          <div class="alert alert-danger w-50" role="alert">
             llena todos los campos obligatorios!
          </div>`;
          detalle.innerHTML = `<p class="p-2 small text-white text-center">NO HAY DETALLES</p>`;
        } else {
          msj.innerHTML = `
          <div class="alert alert-primary w-50" role="alert">
            ${data.msg}  
          </div>`;
          enviar.disabled = true;
          campos.disabled = true;
          editar.disabled = false;

          let clienteAlt;
          if (data.detalle.clienteAlternativo === 0) {
            clienteAlt = "---";
          } else {
            clienteAlt = data.detalle.clienteAlternativo;
          }

          detalle.innerHTML = `
          <ul class="p-2 text-white text-left">
            <li><span class="font-weight-bold">Cliente:</span>  ${
              data.usuario.nombre
            } ${data.usuario.apellido}</li>
            <li><span class="font-weight-bold">Punto de entrega:</span>  ${
              data.puntoYBici.dirPunto
            }</li>
            <li><span class="font-weight-bold">N° de bicicleta:</span>  ${
              data.puntoYBici.numBici
            }</li>
            <li><span class="font-weight-bold">Fecha de alquiler:</span>  ${formato(
              data.detalle.fechaAlquiler
            )}</li>
            <li><span class="font-weight-bold">Hora de inicio alquiler:</span>  ${
              data.detalle.horaInicioAlquiler
            }</li>
            <li><span class="font-weight-bold">Hora de fin alquiler:</span>  ${
              data.detalle.HoraFinAlquiler
            }</li>
            <li><span class="font-weight-bold">Cliente Alternativo:</span>  ${clienteAlt}</li>
          </ul>
          `;
        }
      });
    // .catch((err) => console.log(err));
  }
}

function formato(texto) {
  return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g, "$3/$2/$1");
}
