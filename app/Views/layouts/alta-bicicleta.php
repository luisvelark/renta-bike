<div class="container py-4" style="  background: white;">
    <h3 style="color:blue">ALTA BICICLETA</h3>
    <form id="formularioAltaBicicleta" class="user">

        <div class="form-group">
          <label class="font-weight-bold">*Seleccionar punto de entrega:
            <select id="selector"
              class="form-control form-control-user font-weight-bold custom-select py-3 my-2 h-50 w-75 text-center"
              name="punto-entrega">
              <option selected value="---">---</option>
              <?php for ($i = 0; $i < count($datos); $i++) {
    echo '<option value="' . $datos[$i]['idPuntoED'] . '">' . $datos[$i]['direccion'] . '</option>';
}
?>
            </select>
          </label>
        </div>
        <div class="form-group">
          <label class="font-weight-bold">*Ingrese número de la Bicicleta:
          <input id="nroBicicleta" type="number" class="form-control form-control-user my-1 text-center font-weight-bold"
              name="numeroBicicleta" required autofocus="">
          <span style="color:grey">Ej: 003</span>
          </label>
        </div>
        <div class="form-group">
          <label class="font-weight-bold">*Ingrese precio de la Bicicleta:
          <input id="precio" type="number" class="form-control form-control-user my-1 text-center font-weight-bold"
              name="precioBicicleta" required autofocus="">
          </label>
        </div>
        <button type="submit" class="btn btn-primary btn-lg m-2">Enviar</button>
    </form>
    <hr>
    <div id="respuestaAltaBicicleta">
</div>
</div>
