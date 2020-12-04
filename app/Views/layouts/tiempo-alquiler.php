<div class="container py-4" style="  background: white;">
<h3 style="color:blue">REPORTE DE TIEMPO DE ALQUILER MÁS UTILIZADOS</h3>
<form id="formulario">
  <div>
    <label style="color:black" for="exampleInputPassword1">Ingrese fecha inicio</label>
    <input type="date" class="form-control" name="fechaInicio" required>
    <span style="color:grey">Ej: año-mes-dia</span>
    <br>
    <label style="color:black" for="exampleInputPassword1">Ingrese fecha final</label>
    <input type="date" class="form-control" name="fechaFinal" required>
    <span style="color:grey">Ej: año-mes-dia</span>
  </div>
  <button type="submit" class="btn btn-primary">Obtener tiempo de alquiler</button>
</form>
<hr>
<div id="respuesta">
</div>
</div>

