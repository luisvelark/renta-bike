document.getElementById('idAsignado').addEventListener("click", mostrar, true);


function mostrar(e) {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", estadoIdeal);

    xhr.open('GET', 'http://localhost/renta-bike/GestionController/alquilerAsignado', true);
    xhr.send();

    function estadoIdeal() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let contenedor = document.getElementById('contenido');
            let respuesta = xhr.responseText;

            contenedor.innerHTML = respuesta;
            realizarDevolucion();
            //modalCalificar(enviar, calificar);
        }
    }
}
function realizarDevolucion() {
    var formulario = document.getElementById("form-devolucion2");
    var respuesta = document.getElementById("respuesta2");
    formulario.addEventListener(
        "submit",
        function(e) {
            e.preventDefault();
            console.log("Me diste un click");
            var datos = new FormData(formulario);
            console.log(
                datos.get("ruta"),
                datos.get("daño"),
                datos.get("horaActual")
            );
            fetch(
                    "http://localhost/renta-bike/AlquilerAsignadoController/realizarDevolucion2", {
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
                        $texto = "¡Por favor complete los campos obligatorios!";
                        respuesta.innerHTML = $texto;
                    } else if (data.rta === "suspendido") {
                        respuesta.className = "alert alert-success w-50 text-center";
                        // respuesta.style.backgroundColor = "white";
                        $texto =
                            "¡La devolución se realizó pero el cliente Original fue suspendido!...¡Gracias por elegirnos!";
                        respuesta.innerHTML = $texto;
                    } else {
                        respuesta.className = "alert alert-success w-50 text-center";
                        // respuesta.style.backgroundColor = "white";
                        $texto =
                            "¡La devolución se realizó con éxito!...¡Gracias por elegirnos!";
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
function modalCalificar(ev, c) {
    // Modal calificar;
    $(function() {
        ev.addEventListener("click", () => {
            setTimeout(() => {
                $(c).modal();
            }, 6000);
        });
    });
}