const reportar = document.getElementById("idReportarDaños");
reportar.addEventListener("click", datosAnularAlquiler, true);


const divReportar = document.getElementById("modalReportar");

function datosAnularAlquiler() {
    let url = "http://localhost/renta-bike/datos-reportar-alquiler";
    fetch(url)
        .then((res) => res.json())
        .then((data) => {
            divReportar.innerHTML = `
        <p><span class="font-weight-bold">Estado del Alquiler: </span>${data.alquiler.estadoAlquiler}</p>
        <p><span class="font-weight-bold">Numero de bicicleta: </span>${data.nroBicicleta}</p>
        <p><span class="font-weight-bold">Cliente: </span>${data.usuario.nombre} ${data.usuario.apellido}</p>
        <p><span class="font-weight-bold">Hora de inicio: </span>${data.alquiler.horaInicioAlquiler}</p>
        <p><span class="font-weight-bold">Hora de fin: </span>${data.alquiler.HoraFinAlquiler}</p>
        `;
        });
}