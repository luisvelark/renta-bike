const anular = document.getElementById("idAnular");
anular.addEventListener("click", datosAnularAlquiler, true);

const divModal = document.getElementById("datosAnular");

function datosAnularAlquiler() {
  let url = "http://localhost/renta-bike/datos-anular-alquiler";
  fetch(url)
    .then((res) => res.json())
    .then((data) => {
      divModal.innerHTML = `
        <p><span class="font-weight-bold">Estado del Alquiler: </span>${data.alquiler.estadoAlquiler}</p>
        <p><span class="font-weight-bold">Numero de bicicleta: </span>${data.nroBicicleta}</p>
        <p><span class="font-weight-bold">Cliente: </span>${data.usuario.nombre} ${data.usuario.apellido}</p>
        <p><span class="font-weight-bold">Hora de inicio: </span>${data.alquiler.horaInicioAlquiler}</p>
        <p><span class="font-weight-bold">Hora de fin: </span>${data.alquiler.HoraFinAlquiler}</p>
        `;
    });
}
