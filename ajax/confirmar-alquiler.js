const confirmar = document.getElementById("idConfirmar");
confirmar.addEventListener("click", datosConfirmarAlquiler, true);

const btnConfirmar = document.getElementById("idBotonConfirmar");
btnConfirmar.addEventListener("click", confirmarAlquiler, true);

const divDatos = document.getElementById("datosConfirmar");

function datosConfirmarAlquiler() {
  let url = "http://localhost/renta-bike/datos-confirmar-alquiler";
  fetch(url)
    .then((res) => res.json())
    .then((data) => {
      divDatos.innerHTML = `
      <p><span class="font-weight-bold">Estado del Alquiler: </span>${data.alquiler.estadoAlquiler}</p>
      <p><span class="font-weight-bold">Numero de bicicleta: </span>${data.nroBicicleta}</p>
      <p><span class="font-weight-bold">Cliente: </span>${data.usuario.nombre} ${data.usuario.apellido}</p>
      <p><span class="font-weight-bold">Hora de inicio: </span>${data.alquiler.horaInicioAlquiler}</p>
      <p><span class="font-weight-bold">Hora de fin: </span>${data.alquiler.HoraFinAlquiler}</p>
      `;
    });
}

function confirmarAlquiler() {
  let url = "http://localhost/renta-bike/confirmar-alquiler";
  fetch(url)
    .then((res) => res.json())
    .then((data) => {
      const miAviso = document.getElementById("avisos");
      miAviso.innerHTML = `
      <div class="alert alert-success col-sm-12 text-center w-100" role="alert">
         ${data.msj} 
      </div>`;
      setTimeout(() => {
        // let miAviso = document.getElementById("notif");
        miAviso.style.display = "none";
      }, 15000);
    });
}
