<?php
$hora = new DateTime("now", new DateTimeZone('America/Argentina/Ushuaia'));
?>


<div class="container m-5">
  <div class="row">
    <!-- seccion del formulario! -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-6">

      <h2 class="my-3">Nuevo Alquiler:</h2>


      <form id="form-alquiler">

        <div class="form-group">
          <label class="font-weight-bold">*Seleccionar punto de entrega:
            <select class="custom-select my-2" name="punto-entrega">
              <option selected>---</option>
              <?php for ($i = 0; $i < count($datos); $i++) {
    echo '<option value="' . $datos[$i]['idPuntoED'] . '">' . $datos[$i]['direccion'] . '</option>';
}
?>
            </select>
          </label>
        </div>

        <div class="form-group">
          <label class="font-weight-bold">*Seleccionar hora de inicio:
            <input type="time" class="form-control my-1" name="hora-inicio"
              value=<?php echo '"' . $hora->format('G:i') . '"' ?> min=<?php echo '"' . $hora->format('G:i') . '"' ?>
              max="21:00" step="1">
            <span class="small m-2">*Ingresa una hora mayor a la actual</span>
          </label>
        </div>

        <div class="form-group">
          <label class="font-weight-bold">*Seleccionar cantidad de horas:
            <select class="custom-select my-2" name="cant-hora">
              <option selected>---</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </label>
        </div>

        <div>
          <label class="font-weight-bold">Dni optativo para devolucion:
            <input type="text" class="form-control my-1" name="dni-optativo">
            <span class="small m-2">Ej: 12345678</span>
          </label>
        </div>

        <button type="submit" class="btn btn-primary m-2">Enviar</button>

      </form>

      <div>
        <span class="small my-2">*campos obligatorios</span>
      </div>

      <div id="respuesta" class="mt-3">

      </div>

    </div>

    <!-- seccion del los detalles! -->
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">

      <div class="border border-warning bg-gradient-primary w-75 h-auto">
        <h2 class="p-1 my-2 font-weight-bold text-white text-center">Detalles del alquiler:</h2>
        <hr>
        <div id="detalles"></div>

      </div>

    </div>

  </div>



</div>