<?php
$hora = new DateTime("now", new DateTimeZone('America/Argentina/Ushuaia'));
?>
<h2>Nuevo alquiler</h2>
<div>
  <form class="container">
    <div class="form-group">

      <div>
        <label for="exampleInputEmail1">Seleccionar punto de entrega</label>
        <select class="custom-select">
          <option selected>---</option>
          <?php
          for ($i = 0; $i < count($datos); $i++) {
            echo '<option value="' . $datos[$i]['idPuntoED'] . '">' . $datos[$i]['direccion'] . '</option>';
          }
          ?>
        </select>
      </div>
      <div>
        <label for="exampleInputPassword1">Seleccionar hora de inicio</label>
        <input class="form-control" type="time" value=<?php echo '"' . $hora->format('G:i') . '"'?> min=<?php echo '"' . $hora->format('G:i') . '"' ?> max="21:00" step="1">
      </div>

      <div>
        <label for="exampleInputEmail1">Seleccionar cantidad de horas</label>
        <select class="custom-select">
          <option selected>---</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
        </select>
      </div>
      <div>
        <label for="exampleInputPassword1">Dni optativo para devolucion</label>
        <input type="text" class="form-control" id="exampleInputPassword1">
        <span>Ej: 12345678</span>
      </div>
          <br>
      <button type="submit" class="btn btn-primary">¡Alquilar!</button>
    </div>
  </form>

</div>