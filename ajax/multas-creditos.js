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
            buscarCliente();
        }
    }
}
function buscarCliente() {
    var formulario = document.getElementById('formulario');
    var respuesta = document.getElementById('respuesta');
    formulario.addEventListener('submit',function(e){
        e.preventDefault();
        console.log("Me diste un click");
        var datos =new FormData(formulario);
        console.log(datos.get('dniCliente'))
        fetch("http://localhost/renta-bike/ClienteController/buscarCliente",{
            method: 'POST',
            body: datos
        })
            .then( res => res.json())
            .then( data => {
                if (data === 'error'){
                    respuesta.innerHTML=data;
                }
                else{
                    var tabla='<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
                    tabla +='<thead>';
                    tabla +='<tr>';
                    tabla +='<th>Monto</th>';
                    tabla +='<th>Fecha de multa</th>';
                    tabla +='<th>Detalle</th>';
                    tabla +='<th>Pagado</th>';
                    tabla +='</tr>';
                    tabla +='</thead>';
                    tabla +='<tbody>';
                    for ($i = 0; $i < count(data.multas); $i++){
                        tabla +='<tr>';
                        tabla +='<td>'+data.multas[$i].monto+'</td>';
                        tabla +='<td>'+data.multas[$i].fechaMulta+'</td>';
                        tabla +='<td>'+data.multas[$i].detalleMulta+'</td>';
                        tabla +='<td>'+data.multas[$i].pagado+'</td></tr>';
                    }
                    tabla +='</tbody>';
                    tabla +='</tabla>';
                    respuesta.innerHTML=tabla;
                    console.log(data.multas[0].monto)
                    console.log(data.credito)
            }
            })
    },true)
}