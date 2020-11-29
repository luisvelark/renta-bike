const confirmar = document.getElementById("idConfirmar");
confirmar.addEventListener("click", datosConfirmarAlquiler, true);

const btnConfirmar = document.getElementById("idBotonConfirmar");
btnConfirmar.addEventListener("click", confirmarAlquiler, true);

const divDatos = document.getElementById("datosConfirmar");
const notificaciones = document.getElementById("notificaciones");

function datosConfirmarAlquiler() {
    let url = "http://localhost/renta-bike/datos-confirmar-alquiler";
    fetch(url)
        .then((res) => res.json())
        .then((data) => {
            divDatos.innerHTML = `
      <p><span class="font-weight-bold">Estado del Alquiler: </span>${data.alquiler.estadoAlquiler}</p>
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
            notificaciones.innerHTML = `
      <div id="notif" class="alert alert-success col-sm-3 w-50 text-center font-weight-bold" role="alert" tabindex="-1">
         ${data.msj} :-)
      </div>`;
            setTimeout(() => {
                let div = document.getElementById("notif");
                div.style.display = "none";
            }, 4000);
        });
}