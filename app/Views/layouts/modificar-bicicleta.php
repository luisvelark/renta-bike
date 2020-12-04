<div class="container py-4" style="  background: white;">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
      <h3 style="color:blue">MODIFICAR BICICLETA</h3>
      <form id="formularioBuscar">
        <div class="form-group">
            <label class="font-weight-bold">*Ingrese número de la Bicicleta:
            <input type="number" class="form-control form-control-user my-1 text-center font-weight-bold"
                name="numeroBicicleta" required autofocus="">
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Buscar bicicleta</button>
      </form>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">

      <div class="border border-warning bg-gradient-primary w-75 h-auto">
        <h5 class="p-1 my-2 font-weight-bold text-white text-center">Todas las bicicletas</h5>
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
        <th style="color:white;">Número de bicicleta</th>
        <th style="color:white;">Estado</th>
        </tr>
        </thead>
        <?php 
            //echo $datos[1];
            
            for ($i = 0; $i < count($datos); $i++) {
              echo '<tr>';
              echo '<td style="color:white;"><a>'.$datos[$i]['numeroBicicleta'].'</a></td>';
              echo '<td style="color:white;"><a>'.$datos[$i]['estado'].'</a></td>';
              echo '</tr>';
            }
        ?>
        </table>
      </div>
    </div>
  </div>
  <hr>
<div id="respuestaBicicleta">
</div>
<hr>
<div id="respuestaModificar">
</div>
</div>
