<div>
    <h3 style="color:blue">ALTA BICICLETA</h3>
    <form id="form-alquiler" class="user">

        <div class="form-group">
          <label class="font-weight-bold">*Seleccionar punto de entrega:
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
          <label class="font-weight-bold">*Ingrese número de la Bicicleta:
          <input type="text" class="form-control form-control-user my-1 text-center font-weight-bold"
              name="numeroBicicleta" autofocus="">
          </label>
        </div>
        <div class="form-group">
          <label class="font-weight-bold">*Ingrese precio de la Bicicleta:
          <input type="text" class="form-control form-control-user my-1 text-center font-weight-bold"
              name="precioBicicleta" autofocus="">
          </label>
        </div>
        <button type="submit" class="btn btn-primary btn-lg m-2">Enviar</button>
      </form>
</div>
<div id="respuesta">
</div>