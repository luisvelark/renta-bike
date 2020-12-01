<div class="container py-4" style="background: white">
  <h1>Alquileres concretados</h1>


  <div class=" card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Información de alquileres</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Fecha de alquiler</th>
            <th>Hora de inicio</th>
            <th>Hora de fin</th>
            <th>Hora de entrega</th>
            <th>Punto de entrega</th>
            <th>Punto de devolución</th>
            <th>Numero de bicicleta</th>
            
          </tr>
        </thead>
        <tbody>
          <?php
for ($i = 0; $i < count($alquileres); $i++) {
    echo '<tr>' .
    '<td>' . date("d/m/Y", strtotime($alquileres[$i]['fechaAlquiler'])) . '</td>' .
    '<td>' . $alquileres[$i]['horaInicioAlquiler'] . '</td>' .
    '<td>' . $alquileres[$i]['HoraFinAlquiler'] . '</td>' .
    '<td>' . $alquileres[$i]['HoraEntregaAlquiler'] . '</td>'.
    '<td>' . $alquileres[$i]['inicio'] . '</td>' .
    '<td>' . $alquileres[$i]['fin'] . '</td>' .
    '<td>' . $alquileres[$i]['numB'] . '</td>' .'</tr>';
}?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>