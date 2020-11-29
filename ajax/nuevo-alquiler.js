//VENTANA DE NUEVO ALQUILER!
const btnAlquiler = document.getElementById("idAlquiler");
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

      consultaAlquiler();

      const editar = document.getElementById("idEditar");
      editar.addEventListener(
        "click",
        () => {
          const enviar = document.getElementById("idEnviar");
          const campos = document.getElementById("idCampos");
          habilitarCampos(campos, enviar, editar);
        },
        true
      );

      const formAlquiler = document.getElementById("form-alquiler");
      formAlquiler.addEventListener(
        "submit",
        (e) => {
          enviarAlquiler(e);
        },
        true
      );
    }
  }
}

function consultaAlquiler() {
  let url = "http://localhost/renta-bike/hay-alquiler-nuevo";
  //recibo existe:true , datos:alquiler;
  fetch(url)
    .then((res) => res.json())
    .then((datos) => {
      if (datos.existe === true) {
        const punto = document.getElementById("idPunto");
        const hora = document.getElementById("horaAlquiler");
        const dni = document.getElementById("dniOptativo");
        const editar = document.getElementById("idEditar");
        const enviar = document.getElementById("idEnviar");
        const campos = document.getElementById("idCampos");

        // const cantHora = document.getElementById("idCantHora");

        // let formulario = new FormData(form);
        // formulario.set("punto-entrega", datos.puntoBici.dirPunto);
        punto.value = datos.alquiler.idPuntoE;
        hora.value = datos.alquiler.horaInicioAlquiler;
        dni.value = datos.alquiler.clienteAlternativo;

        console.log(datos.puntoBici.dirPunto);
        console.log(datos.alquiler.horaInicioAlquiler);

        deshabilitarCampos(campos, enviar, editar);
      }
    });
}

function enviarAlquiler(e) {
  //ENVIO DE FORMULARIO ALQUILER
  const msj = document.getElementById("respuesta");
  const detalles = document.getElementById("detalles");
  const enviar = document.getElementById("idEnviar");
  const campos = document.getElementById("idCampos");
  const editar = document.getElementById("idEditar");

  e.preventDefault();
  console.log("envie");

  var datos = new FormData(e.target);

  let url = "http://localhost/renta-bike/alquiler-nuevo";

  fetch(url, {
    method: "POST",
    body: datos,
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      if (data.code !== "500") {
        if (data.msg === "error") {
          msj.innerHTML = `
          <div id="noti" class="alert alert-danger w-50" role="alert">
             llena todos los campos obligatorios!
          </div>`;

          detalles.innerHTML = `<p class="p-2 small text-white text-center">NO HAY DETALLES</p>`;
        } else {
          msj.innerHTML = `
          <div id="noti" class="alert alert-primary w-50" role="alert">
            ${data.msg}  
          </div>`;

          deshabilitarCampos(campos, enviar, editar);

          let clienteAlt;
          if (data.detalle.clienteAlternativo === 0) {
            clienteAlt = "---";
          } else {
            clienteAlt = data.detalle.clienteAlternativo;
          }

          detalles.innerHTML = `
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
      } else {
        msj.innerHTML = `
          <div id="noti" class="alert alert-danger w-100 text-center" role="alert">
             "${data.aviso}"
             <p class="mb-0">-Seleccione otro punto de entrega porfavor.</p>
          </div>`;
      }

      setTimeout(() => {
        let div = document.getElementById("noti");
        div.style.display = "none";
      }, 6000);
    });
  // .catch((err) => console.log(err));
}

function formato(texto) {
  return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g, "$3/$2/$1");
}

function deshabilitarCampos(camp, env, edi) {
  env.disabled = true;
  camp.disabled = true;
  edi.disabled = false;
}

function habilitarCampos(camp, env, edi) {
  camp.disabled = false;
  env.disabled = false;
  edi.disabled = true;
}
