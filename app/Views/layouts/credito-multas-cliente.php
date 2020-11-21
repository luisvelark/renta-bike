<div>
  <h1>Multa/s y crédito </h1>

  <?php
  $multas = $datos['multas'];
  ?>

  <br>
  <h4> Tu crédito actual es: <?php echo $datos['credito'] ?> </h4> <br>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Información de multas</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Monto</th>
              <th>Fecha de multa</th>
              <th>Detalle</th>
              <th>Pagado</th>
            </tr>
          </thead>
          <tbody>
            <?php
            for ($i = 0; $i < count($multas); $i++) {
              echo '<tr>
       <td>' . $multas[$i]['monto'] . '</td>' .
                '<td>' . $multas[$i]['fechaMulta'] . '</td>' .
                '<td>' . $multas[$i]['detalleMulta'] . '</td>' .
                '<td>' . $multas[$i]['pagado'] . '</td></tr>';
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>