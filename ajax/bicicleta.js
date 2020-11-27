document.getElementById('idAlta').addEventListener("click", mostrarAlta, true);
document.getElementById('idModificar').addEventListener("click", mostrarModificar, true);
document.getElementById('idBaja').addEventListener("click", mostrarBaja, true);

function mostrarAlta(e) {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", estadoIdeal);

    xhr.open('GET', 'http://localhost/renta-bike/GestionController/altaBicicleta', true);
    // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send();

    function estadoIdeal() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            let respuesta = xhr.responseText;

            let contenedor = document.getElementById('contenido');
            contenedor.innerHTML = respuesta;
            realizarAlta();
        }
    }
}
function realizarAlta(){
    var formulario = document.getElementById('formularioAltaBicicleta');
    var respuesta = document.getElementById('respuestaAltaBicicleta');
    formulario.addEventListener('submit',function(e){
        e.preventDefault();
        console.log("Me diste un click");
        var datos =new FormData(formulario);
        fetch("http://localhost/renta-bike/BicicletaController/solicitarBicicleta",{
            method: 'POST',
            body: datos
        })
            .then( res => res.json())
            .then( data => {
                if (data === 'error'){
                    respuesta.innerHTML=data;
                }
                else{
                    respuesta.innerHTML=data;
                    
            }
            })
    },true)
}
function mostrarModificar(e) {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", estadoIdeal);

    xhr.open('GET', 'http://localhost/renta-bike/GestionController/modificarBicicleta', true);
    // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send();

    function estadoIdeal() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            let respuesta = xhr.responseText;

            let contenedor = document.getElementById('contenido');
            contenedor.innerHTML = respuesta;
            buscarBicicleta();
        }
    }
}

function buscarBicicleta(){
    var formulario = document.getElementById('formularioBuscar');
    var respuesta1 = document.getElementById('respuestaBicicleta');
    formulario.addEventListener('submit',function(e){
        e.preventDefault();
        var datos =new FormData(formulario);
        fetch("http://localhost/renta-bike/BicicletaController/mostrarBicicleta",{
            method: 'POST',
            body: datos
        })
            .then( res => res.json())
            .then( data => {
                if (data === 'error'){
                    $texto='<h3>No existe esa bicicleta</h3>';
                    respuesta1.innerHTML=$texto;
                }
                else{
                    //console.log(data.bicicleta.numeroBicicleta)
                    tabla='<form id="formularioModificar">';
                    tabla+='<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
                    tabla +='<thead>';
                    tabla +='<tr>';
                    tabla +='<th style="color:black;">Valor Actual</th>';
                    tabla +='<th style="color:black;">Valor a modificar</th>';
                    tabla +='</tr>';
                    tabla +='</thead>';
                    tabla +='<tbody>';
                    tabla+='<tr>';
                    tabla+='<td>Numero Bicicleta: '+data.bicicleta.numeroBicicleta+'</td>';
                    tabla+='<td>';
                    tabla+='<label class="font-weight-bold">Ingrese nuevo numero de la Bicicleta:';
                    tabla+='<input type="number" value="'+data.bicicleta.numeroBicicleta+'" class="form-control form-control-user my-1 text-center font-weight-bold" name="numeroBicicleta" autofocus="">';
                    tabla+='</label>';
                    tabla+='</td>';
                    tabla+='</tr>';
                    tabla+='<tr>';
                    tabla+='<td>Estado Bicicleta: '+data.bicicleta.estado+'</td>';  
                    tabla+='<td>';
                    tabla+='<select id="1" name="selectorEstado" class="form-control form-control-user custom-select py-3 my-2 h-50 w-50 text-center font-weight-bold>';
                    if(data.bicicleta.estado=='Disponible'){
                        tabla+='<option value="Disponible">Disponible</option>';
                        tabla+='<option value="Disponible">Disponible</option>';
                        tabla+='<option value="EnAlquiler">En alquiler</option>';
                        tabla+='<option value="EnReparacion">En reparacion</option>';
                    }else if(data.bicicleta.estado=='EnAlquiler'){
                        tabla+='<option value="EnAlquiler">En alquiler</option>';
                        tabla+='<option value="EnAlquiler">En alquiler</option>';
                        tabla+='<option value="Disponible">Disponible</option>';
                        tabla+='<option value="EnReparacion">En reparacion</option>';
                    }else{
                        tabla+='<option value="EnReparacion">En reparacion</option>';
                        tabla+='<option value="EnReparacion">En reparacion</option>';
                        tabla+='<option value="EnAlquiler">En alquiler</option>';
                        tabla+='<option value="Disponible">Disponible</option>';
                    }
                    tabla+='</select>';
                    tabla+='</td>';
                    tabla+='</tr>';
                    tabla+='<tr>';
                    tabla+='<td>Daño Bicicleta: '+data.bicicleta.daño+'</td>';  
                    tabla+='<td>';
                    tabla+='<select id="2" name="selectorDaño" class="form-control form-control-user custom-select py-3 my-2 h-50 w-50 text-center font-weight-bold> ';
                    if(data.bicicleta.daño=='SinDanio'){
                        tabla+='<option value="SinDanio">Sin daño</option>';
                        tabla+='<option value="SinDanio">Sin daño</option>';
                        tabla+='<option value="Recuperable">Recuperable</option>';
                        tabla+='<option value="Irrecuperable">Irrecuperable</option>';
                    }else if(data.bicicleta.daño=='Recuperable'){
                        tabla+='<option value="Recuperable">Recuperable</option>';
                        tabla+='<option value="Recuperable">Recuperable</option>';
                        tabla+='<option value="SinDanio">Sin daño</option>';
                        tabla+='<option value="Irrecuperable">Irrecuperable</option>';
                    }else{
                        tabla+='<option value="Irrecuperable">Irrecuperable</option>';
                        tabla+='<option value="Irrecuperable">Irrecuperable</option>';
                        tabla+='<option value="Recuperable">Recuperable</option>';
                        tabla+='<option value="SinDanio">Sin daño</option>';
                    }
                    tabla+='</select>';
                    tabla+='</td>';
                    tabla+='</tr>';
                    tabla+='<tr>';
                    tabla+='<td>Precio de la Bicicleta: '+data.bicicleta.precio+'</td>';
                    tabla+='<td>';
                    tabla+='<label class="font-weight-bold">Ingrese nuevo precio de la Bicicleta:';
                    tabla+='<input type="number" value="'+data.bicicleta.precio+'" class="form-control form-control-user my-1 text-center font-weight-bold" name="precioBicicleta" autofocus="">';
                    tabla+='</label>';
                    tabla+='</td>';
                    tabla+='</tr>';
                    tabla+='<tr>';
                    if(data.bicicleta.observaciones!==''){
                        tabla+='<td>Observaciones: '+data.bicicleta.observaciones+'</td>';
                    }else{  
                        tabla+='<td>Observaciones: No tiene observaciones</td>';
                    }
                    tabla+='<td>';
                    tabla+='<label class="font-weight-bold">Ingrese nueva observacion de la Bicicleta:';
                    //tabla+='<input type="text" class="form-control form-control-user my-1 text-center font-weight-bold" name="numeroBicicleta" autofocus="">';
                    tabla+='<textarea name="observaciones" value="'+data.bicicleta.observaciones+'" class="form-control" rows="3"></textarea>';
                    tabla+='</label>';
                    tabla+='</td>';
                    tabla+='</tr>';
                    tabla+='<tr>';
                    tabla+='<td colspan="2"><button type="submit" class="btn btn-primary">Modificar bicicleta</button></td>';
                    tabla+='<input name="idBicicleta" type="hidden" value="'+data.bicicleta.idBicicleta+'"></input>';
                    tabla+='</tr>';
                    tabla +='</tbody>';
                    tabla+='</table>';
                    tabla+='</form>';
                    respuesta1.innerHTML=tabla;
                    modificarBicicleta();
            }
            })
    },true)
}

function modificarBicicleta(){
    var formulario = document.getElementById('formularioModificar');
    var respuesta1 = document.getElementById('respuestaModificar');
    formulario.addEventListener('submit',function(e){
        e.preventDefault();
        console.log("me diste clic");
        var datos =new FormData(formulario);
        console.log(datos.get("observaciones"));
        fetch("http://localhost/renta-bike/BicicletaController/modificarBicicleta",{
            method: 'POST',
            body: datos
        })
            .then( res => res.json())
            .then( data => {
                if (data === 'error'){
                    respuesta1.innerHTML=data;
                }
                else{
                    respuesta1.innerHTML=data;
            }
            })
    },true)
}

function mostrarBaja(e) {
    let xhr = new XMLHttpRequest();
    xhr.addEventListener("readystatechange", estadoIdeal);

    xhr.open('GET', 'http://localhost/renta-bike/GestionController/bajaBicicleta', true);
    // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send();

    function estadoIdeal() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            let respuesta = xhr.responseText;

            let contenedor = document.getElementById('contenido');
            contenedor.innerHTML = respuesta;
            eliminaBicicleta();
        }
    }
}
function eliminaBicicleta(){
    var formulario = document.getElementById('formularioBajaBicicleta');
    var respuesta = document.getElementById('respuestaBajaBicicleta');
    formulario.addEventListener('submit',function(e){
        e.preventDefault();
        var datos =new FormData(formulario);
        console.log(datos.get('numeroBicicleta'));
        fetch("http://localhost/renta-bike/BicicletaController/darBajaBicicleta",{
            method: 'POST',
            body: datos
        })
            .then( res => res.json())
            .then( data => {
                if (data === 'error'){
                    texto='<h3>No existe esa bicicleta<h3>';
                    respuesta.innerHTML=texto;
                }
                else{
                    //console.log(data.bicicleta);
                    //console.log(data.fecha);
                    respuesta.innerHTML=data;
                    
            }
            })
    },true)
}