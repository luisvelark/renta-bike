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
        fetch("http://localhost/renta-bike/ClienteController/mostrarCliente",{
            method: 'POST',
            body: datos
        })
            .then( res => res.json())
            .then( data => {
                if (data === 'error'){
                    respuesta.innerHTML=data;
                }
                else{
                    console.log(data)
                    var tabla='<br><h3>'+data.usuario.nombre+' '+data.usuario.apellido+' crédito actual es: '+data.multaCredito.credito+'<br> <br>';
                    tabla +='<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
                    tabla +='<thead>';
                    tabla +='<tr>';
                    tabla +='<th>Monto</th>';
                    tabla +='<th>Fecha de multa</th>';
                    tabla +='<th>Detalle</th>';
                    tabla +='<th>Pagado</th>';
                    tabla +='</tr>';
                    tabla +='</thead>';
                    tabla +='<tbody>';
                    for ($i = 0; $i < data.multaCredito.multas.length; $i++){
                        tabla +='<tr>';
                        tabla +='<td>'+data.multaCredito.multas[$i].monto+'</td>';
                        tabla +='<td>'+data.multaCredito.multas[$i].fechaMulta+'</td>';
                        tabla +='<td>'+data.multaCredito.multas[$i].detalleMulta+'</td>';
                        tabla +='<td>'+data.multaCredito.multas[$i].pagado+'</td></tr>';
                    }
                    tabla +='</tbody>';
                    tabla +='</tabla>';
                    respuesta.innerHTML=tabla;
            }
            })
    },true)
}