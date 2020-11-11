<div class="container my-5">

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
        <input type="text" class="form-control my-1" name="hora-inicio">
        <span class="small m-2">Ejemplo: 20hs - 22hs</span>
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