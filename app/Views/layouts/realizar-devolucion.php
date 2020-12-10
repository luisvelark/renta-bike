<?php
$miHora = new DateTime("now", new DateTimeZone('America/Argentina/Ushuaia'));
?>


<div class="container py-4" style="  background: white;">
  <div class="row">
    <!-- seccion del formulario! -->
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">

      <h2 class="my-3">Realizar Devolución:</h2>
      <form id="form-devolucion" class="user">

        <div class="form-group">
          <label class="font-weight-bold">*Seleccionar punto de devolución:
            <select
              class="form-control form-control-user font-weight-bold custom-select py-3 my-2 h-50 w-75 text-center"
              name="punto-entrega">
              <option selected>---</option>
              <?php for ($i = 0; $i < count($datos); $i++) {
    echo '<option value="' . $datos[$i]['idPuntoED'] . '">' . $datos[$i]['direccion'] . '</option>';
}
?>
            </select>
          </label>
        </div>

        <div class="form-group">
          <label class="font-weight-bold">*Daños de la bicicleta:
            <select
              class="form-control form-control-user custom-select py-3 my-2 h-50 w-100 text-center font-weight-bold"
              name="daño">
              <option selected>---</option>
              <option value="SinDanio">Sin Daño</option>
              <option value="Recuperable">Recuperable</option>
              <option value="Irrecuperable">Irrecuperable</option>

            </select>
          </label>
        </div>

        <div class="form-group">
          <label class="font-weight-bold">Especificar daños:
            <textarea class="form-control"
              name="espeDaños" rows="3"></textarea>
          </label>
        </div>


        <div class="form-group">
          <label class="font-weight-bold">Ruta:
            <textarea class="form-control"
              name="ruta" rows="3"></textarea>
          </label>
        </div>

        <div class="form-group">
          <label class="font-weight-bold">Hora de entrega:

            <input type="time" class="form-control form-control-user font-weight-bold py-3 pl-3 my-1 w-100 h-50 "
              value=<?php echo '"' . $miHora->format('G:i:s') . '"' ?>
              min=<?php echo '"' . $miHora->format('G:i') . '"' ?> max="23:00" step="1" disabled>
          </label>
          <input type="hidden" name="horaActual" value=<?php echo '"' . $miHora->format('G:i:s') . '"' ?>>
          <input type="hidden" name="idAlquiler" value=<?php echo $alquiler['idAlquiler'] ?>>
          <input type="hidden" name="horaFin" value=<?php echo $alquiler['HoraFinAlquiler'] ?>>
        </div>

        <button id="idBotonRealizar" type="submit" class="btn btn-primary btn-lg m-2">Enviar</button>

      </form>

      <div>
        <span class="small my-2">*Campos obligatorios</span>
      </div>



    </div>

  </div>
  <div id="respuesta"></div>


</div>