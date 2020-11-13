document.getElementById('idMultasCredito').addEventListener("click", mostrar, true);


function mostrar(e) {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", estadoIdeal);

    xhr.open('GET', 'http://localhost/renta-bike/GestionController/multascredito', true);
    // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send();

    function estadoIdeal() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            let respuesta = xhr.responseText;

            let contenedor = document.getElementById('contenido');
            contenedor.innerHTML = respuesta;
            console.log("Esta por ejecutarse buscarCliente");
            buscarCliente();
        }
    }
}
function buscarCliente() {
    var formulario = document.getElementById('formulario');

    formulario.addEventListener('submit',function(e){
        e.preventDefault();
        console.log("Me diste un click");
    },true)
}