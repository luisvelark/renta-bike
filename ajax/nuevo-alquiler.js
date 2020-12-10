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

      const inputClienteAlt = document.getElementById("dniOptativo");
      inputClienteAlt.addEventListener("keyup", consultarClienteAlt);
    }
  }
}

function consultarClienteAlt(e) {
  // let existe = true;
  const msjClienteAlt = document.getElementById("msjClienteAlt");
  // const inpClienteAlt = document.getElementById("dniOptativo");
  let clienteAlter = e.target.value;
  // if (clienteAlter != "") {
  console.log(clienteAlter);
  let miForm = new FormData();
  miForm.append("dni", clienteAlter);
  let url = "http://localhost/renta-bike/cliente-alternativo";
  console.log(url);
  fetch(url, {
    method: "POST",
    body: miForm,
  })
    .then((res) => res.json())
    .then((valores) => {
      if (valores.code != 500) {
        msjClienteAlt.style.color = "green";
        msjClienteAlt.innerHTML = `El cliente registrado es: ${valores.cliente.nombre} ${valores.cliente.apellido}`;
      } else {
        // e.target.setAttribute("required");
        if (clienteAlter === "") {
          // e.target.removeAttribute("required");
          msjClienteAlt.style.display = "none";
        } else {
          // e.target.setAttribute("required", "");

          msjClienteAlt.style.display = "block";
          msjClienteAlt.style.color = "red";
          msjClienteAlt.innerHTML = `El cliente no esta resgistrado!`;

          console.log("hola");
        }
      }
      console.log(valores);
    });
  // } else {
  //   msjClienteAlt.style.display = "none";
  // }
}

function consultaAlquiler() {
  let url = "http://localhost/renta-bike/hay-alquiler-nuevo";
  //recibo existe:true , datos:alquiler;
  fetch(url)
    .then((res) => res.json())
    .then((datos) => {
      if (datos.existe === true) {
        const titulo = document.getElementById("tituloAlquiler");
        titulo.innerHTML = "Mi alquiler:";

        const punto = document.getElementById("idPunto");
        const hora = document.getElementById("horaAlquiler");
        const dni = document.getElementById("dniOptativo");
        const editar = document.getElementById("idEditar");
        const enviar = document.getElementById("idEnviar");
        const campos = document.getElementById("idCampos");
        const detalles = document.getElementById("detalles");

        punto.value = datos.alquiler.idPuntoE;
        hora.value = datos.alquiler.horaInicioAlquiler;
        dni.value = datos.alquiler.clienteAlternativo;

        let clienteAl;
        if (datos.alquiler.clienteAlternativo == 0) {
          clienteAl = "---";
        } else {
          clienteAl = datos.alquiler.clienteAlternativo;
        }

        detalles.innerHTML = `
          <ul class="p-2 text-white text-left">
            <li><span class="font-weight-bold">Cliente:</span>  ${
              datos.usuario.nombre
            } ${datos.usuario.apellido}</li>
            <li><span class="font-weight-bold">Punto de entrega:</span>  ${
              datos.puntoBici[0].direccion
            }</li>
            <li><span class="font-weight-bold">N° de bicicleta:</span>  ${
              datos.puntoBici[1].numeroBicicleta
            }</li>
            <li><span class="font-weight-bold">Fecha de alquiler:</span>  ${formato(
              datos.alquiler.fechaAlquiler
            )}</li>
            <li><span class="font-weight-bold">Hora de inicio alquiler:</span>  ${
              datos.alquiler.horaInicioAlquiler
            }</li>
            <li><span class="font-weight-bold">Hora de fin alquiler:</span>  ${
              datos.alquiler.HoraFinAlquiler
            }</li>
            <li><span class="font-weight-bold">Cliente alternativo:</span>  ${clienteAl}</li>
          </ul>
          `;

        // console.log(datos.puntoBici.dirPunto);
        // console.log(datos.alquiler.horaInicioAlquiler);

        deshabilitarCampos(campos, enviar, editar);
      } else {
        //no hay alquileres activos!
        const miAviso = document.getElementById("avisos");
        miAviso.innerHTML = `
      <div class="alert alert-info col-sm-12 text-center w-100" role="alert">
         ${datos.aviso} 
      </div>`;
        setTimeout(() => {
          // let div = document.getElementById("notif");
          miAviso.style.display = "none";
        }, 6000);
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
             ¡Llenar todos los campos obligatorios!
          </div>`;

          detalles.innerHTML = `<p class="p-2 small text-white text-center">NO HAY DETALLES</p>`;
        }else if(data.msg==="fueraHorario"){
          msj.innerHTML = `
  <div id="noti" class="alert alert-danger w-50" role="alert">
     ¡El horario de alquiler es de 8am a 9pm!
  </div>`;

            detalles.innerHTML = `<p class="p-2 small text-white text-center">Aún no hay detalles</p>`;
        } else {
          if (data.code == 1000) {
            return (msj.innerHTML = `
          <div id="noti" class="alert alert-primary w-50" role="alert">
            verifica el dni del cliente optativo para su devolucion! 
          </div>`);
          }
          //su reserva se realizo con exito!
          msj.innerHTML = `
          <div id="noti" class="alert alert-primary w-50" role="alert">
            ${data.msg}  
          </div>`;

          deshabilitarCampos(campos, enviar, editar);
          console.log("editar activado");

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
              data.dirPunto
            }</li>
            <li><span class="font-weight-bold">N° de bicicleta:</span>  ${
              data.numBici
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
        //No existen bicicletas disponibles en el punto de entrega.
        msj.innerHTML = `
          <div id="noti" class="alert alert-danger w-100" role="alert">
             ${data.aviso}
             <p class="mb-0">-Seleccione otro punto de entrega por favor</p>
             <p class="mb-0">-Por otros motivos, comuniquese al call center(0800-222-0224)</p>


          </div>`;
      }

      setTimeout(() => {
        let div = document.getElementById("noti");
        div.style.display = "none";
      }, 10000);
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
