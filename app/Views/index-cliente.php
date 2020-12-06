<?php
$user_session = session();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Renta Bike - Home</title>

  <!-- Custom fonts for this template -->
  <link href="<?php echo base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('/css/css.css') ?>" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?php echo base_url('vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="<?php echo base_url(); ?>/GestionController/indexCliente">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-bicycle"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Renta Bike</div>
      </a>


      <!-- Divider -->
      <hr class="sidebar-divider my-0">



      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Acciones
      </div>


      <!--  componentes -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-bicycle"></i>
          <span>Alquiler</span>
        </a>
        <!-- Botones opciones alquiler-->

        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">

            <?php if ($user_session->suspendido == 1) {?>
            <a id="idAlquiler" class="collapse-item" href="#" hidden> <i class="fas fa-plus-square"></i> Nuevo
              alquiler</a>
            <a id="idRealizarDevolucion" class="collapse-item" href="#" hidden> <i class="fas fa-arrow-circle-up"></i>
              Realizar devolución </a>
            <a id="idConfirmar" class="collapse-item" href="#" hidden> <i class="fas fa-check-circle"></i> Confirmar
              alquiler</a>
            <a id="idAnular" class="collapse-item" href="#" hidden> <i class="fas fa-ban"></i> Anular alquiler</a>
            <?php } else {?>

            <?php if ($user_session->activo == '0') {?>
            <a id="idAlquiler" class="collapse-item" href="#"> <i class="fas fa-plus-square"></i> Nuevo alquiler</a>
            <a id="idRealizarDevolucion" class="collapse-item" href="#" hidden> <i class="fas fa-arrow-circle-up"></i>
              Realizar devolución </a>
            <a id="idConfirmar" class="collapse-item" href="#" hidden> <i class="fas fa-check-circle"></i> Confirmar
              alquiler</a>
            <a id="idAnular" class="collapse-item" href="#" hidden> <i class="fas fa-ban"></i> Anular alquiler</a>

            <?php } else if ($user_session->activo == '1') {

    ?>
            <a id="idAlquiler" class="collapse-item" href="#"> <i class="fas fa-plus-square"></i> Mi alquiler</a>
            <a id="idRealizarDevolucion" class="collapse-item" href="#" hidden> <i class="fas fa-arrow-circle-up"></i>
              Realizar
              devolución </a>
            <a id="idConfirmar" class="collapse-item" href="#"> <i class="fas fa-check-circle"></i> Confirmar
              alquiler</a>
            <a id="idAnular" class="collapse-item" href="#"> <i class="fas fa-ban"></i> Anular alquiler</a>
            <?php } else {?>
            <a id="idAlquiler" class="collapse-item" href="#" hidden> <i class="fas fa-plus-square"></i> Nuevo
              alquiler</a>
            <a id="idRealizarDevolucion" class="collapse-item" href="#"> <i class="fas fa-arrow-circle-up"></i> Realizar
              devolución </a>
            <a id="idConfirmar" class="collapse-item" href="#" hidden> <i class="fas fa-check-circle"></i> Confirmar
              alquiler</a>
            <a id="idAnular" class="collapse-item" href="#" hidden> <i class="fas fa-ban"></i> Anular alquiler</a>
            <?php }?>
            <?php }?>
          </div>
        </div>
      </li>
      <!-- ------------------------------------------------------------------------------------------------------------------------------------------------ -->
      <!-- Modal Confirmar-->
      <div class="modal fade" id="idModalConfirmar" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Confirmar alquiler</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!-- TODO: -->
            <div class="modal-body">
              <div id="datosConfirmar">
              </div>
            </div>
            <div class="modal-footer">
              <button id="idReportarDaños" type="button" class="btn btn-danger" data-dismiss="modal">Reportar
                daños</button>
              <button id="idBotonConfirmar" type="button" class="btn btn-primary"
                data-dismiss="modal">Confirmar</button>
            </div>
          </div>
        </div>
      </div>
      <!----- ------------------------------------------------------------------------------------------------------------------------------------------------ -->
      <!-- Modal Reportar-->
      <div class="modal fade" id="idModalReportar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Reportar daños</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" class="user"
              action="<?php echo base_url(); ?>/AlquilerController/soliticaReportarDaños">
              <div class="modal-body">
                <div id="modalReportar"></div>
                <div class="form-group">
                  <label class="font-weight-bold">Informe el tipo de daño</label><br>
                  <select
                    class="form-control form-control-user font-weight-bold custom-select py-3 my-2 h-50 w-75 text-center"
                    name="comboDaño" id="">
                    <option selected value="Recuperable">Recuperable (daños menores)</option>
                    <option value="Irrecuperable">Irrecuperable (daños funcionales)</option>
                  </select>
                  <input type="hidden" name="idUsuarioOculto" value=" <?php echo $user_session->idUsuario ?>">
                </div>
                <div class="form-group">
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Enviar daños</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- ------------------------------------------------------------------------------------------------------------------------------------------------ -->
      <!-- Modal Anular-->
      <div class="modal fade" id="idModalAnular" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Anular alquiler</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" class="user"
              action="<?php echo base_url(); ?>/AlquilerController/soliticaAnularAlquiler">
              <div class="modal-body">

                <div id="datosAnular">
                </div>

                <div class="form-group">
                  <input type="hidden" name="idUsuarioOculto" value=" <?php echo $user_session->idUsuario ?>">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Anular</button>
              </div>
          </div>
          </form>
        </div>
      </div>
      <!-- ------------CAlIFICAR PUNTOS DE ENTREGA---------------------------------------------------------------------------------------------------------------------- -->

      <div class="modal fade" id="idModalCalificar" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Calificar atención del punto de entrega
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" class="user" action="<?php echo base_url(); ?>/CalificacionController/calificarEntrega">
              <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Calificación del 1 al 5 (1 muy malo, 5 excelente)</label><br>
                  <p class="clasificacion">
                    <input id="radio1" type="radio" name="estrellas" value="5" required>
                    <label style="font-size: 300%;" for="radio1">★</label>
                    <input id="radio2" type="radio" name="estrellas" value="4" required>
                    <label style="font-size: 300%;" for="radio2">★</label>
                    <input id="radio3" type="radio" name="estrellas" value="3" required>
                    <label style="font-size: 300%;" for="radio3">★</label>
                    <input id="radio4" type="radio" name="estrellas" value="2" required>
                    <label style="font-size: 300%;" for="radio4">★</label>
                    <input id="radio5" type="radio" name="estrellas" value="1" required>
                    <label style="font-size: 300%;" for="radio5">★</label>
                  </p>
                  <input type="hidden" name="idUsuarioOculto" value=" <?php echo $user_session->idUsuario ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Comentarios (opcional)</label>
                  <input type="input" name="comentario" class="form-control form-control-user">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enviar calificación</button>
              </div>
          </div>
          </form>
        </div>
      </div>
      <!-- ------------CAlIFICAR PUNTOS DE DEVOLUCION---------------------------------------------------------------------------------------------------------------------- -->
      <div class="modal fade" id="idModalCalificarDevolucion" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Calificar atención del punto de devolución
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" class="user"
              action="<?php echo base_url(); ?>/CalificacionController/calificarDevolucion">
              <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Calificación del 1 al 5 (1 muy malo, 5 excelente)</label><br>
                  <p class="clasificacion">
                    <input id="radio6" type="radio" name="estrellas" value="5" required>
                    <label style="font-size: 300%;" for="radio6">★</label>
                    <input id="radio7" type="radio" name="estrellas" value="4" required>
                    <label style="font-size: 300%;" for="radio7">★</label>
                    <input id="radio8" type="radio" name="estrellas" value="3" required>
                    <label style="font-size: 300%;" for="radio8">★</label>
                    <input id="radio9" type="radio" name="estrellas" value="2" required>
                    <label style="font-size: 300%;" for="radio9">★</label>
                    <input id="radio10" type="radio" name="estrellas" value="1" required>
                    <label style="font-size: 300%;" for="radio10">★</label>
                  </p>
                  <input type="hidden" name="idUsuarioOculto" value=" <?php echo $user_session->idUsuario ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Comentarios (opcional)</label>
                  <input type="input" name="comentario" class="form-control form-control-user">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enviar calificación</button>
              </div>
          </div>
          </form>
        </div>
      </div>


      <!-- ------------------------------------------------------------------------------------------------------------------------------------------------ -->
      <!--  componentes -->
      <li class="nav-item active">
        <a id="idAlquileres" class="nav-link" href="#">
          <i class="fas fa-list-ol"></i>
          <span>Alquileres concretados</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" target="_blank" href="<?php echo base_url(); ?>/GestionController/buscarPuntoED">
          <i class="fas fa-map-marker-alt"></i>
          <span>Buscar puntos de entrega y devolución</span></a>
      </li>
      <li class="nav-item active">
        <a id="idCreditoMultas" class="nav-link" href="#">
          <i class="fas fa-coins"></i>
          <span>Crédito y multas</span></a>
      </li>
      <!-- <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="far fa-file-alt"></i>
          <span>Manual de usuario</span></a>
      </li> -->
      <!--  <li class="nav-item active">
        <a id="idCalificacion" class="nav-link" href="#">
          <i class=" fas fa-star"></i>
          <span>Calificar puntos ED</span></a>
      </li> -->
      <!-- Botones para las acciones -->
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content"
        style="background-image: url(<?php echo base_url('img/Biciseditado.jpg'); ?>); background-size:cover; "
        class="mt-0">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-0 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <form class="form-inline">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
          </form>

          <!-- Topbar Search
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> -->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">
                  <?php if ($user_session->suspendido == 1) {
    echo '+1';
}?>
                </span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alertas
                </h6>
                <?php if ($user_session->suspendido == 1) {?>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">¡Estás suspendido!</div>
                    No vas a poder alquilar durante un tiempo determinado. Acercate a un punto de entrega.
                  </div>
                </a>
                <?php } else {?>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-check-circle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">¡Todo correcto!</div>
                    No hay notificaciones nuevas.
                  </div>
                </a>
                <?php }?>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php echo $user_session->nombre . ' ' . $user_session->apellido; ?></span>
                <i class="fas fa-user"></i>
                <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <?php if ($user_session->suspendido == 1) {?>
                <a id="idModificarPerfil" class="dropdown-item" href="#" hidden >
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Modificar perfil
                </a>
                <a id="idBajaUsuario" class="dropdown-item" href="#" hidden>
                  <i class="fas fa-ban fa-sm fa-fw mr-2 text-gray-400"></i></i>
                  Darme de baja
                </a>
                <?php } else {?>
                  <a id="idModificarPerfil" class="dropdown-item" href="#"  >
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Modificar perfil
                </a>
                <a id="idBajaUsuario" class="dropdown-item" href="#" >
                  <i class="fas fa-ban fa-sm fa-fw mr-2 text-gray-400"></i></i>
                  Darme de baja
                </a>
                <?php }?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url(); ?>/UsuarioController/salirDelSistema">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar sesión
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <div id="avisos">
          <?php
if (isset($msjReportar)) {
    echo '<div id="msjReportar" class="alert alert-success col-sm-12 text-center w-100" role="alert">';
    echo $msjReportar;
    echo '</div>';
}
// <div class="alert alert-success col-sm-12 text-center w-100" role="alert">
//          ${data.msj}
//       </div>`;
if (isset($msjAnular)) {
    echo '<div id="msjAnular" class="alert alert-success col-sm-12 text-center w-100" role="alert">';
    echo $msjAnular;
    echo '</div>';
}
if (isset($msjCalificacion)) {
    echo '<div id="msjCalificar" class="alert alert-success col-sm-12 text-center w-100" role="alert">';
    echo $msjCalificacion;
    echo '</div>';
}

?>
        </div>
        <!-- Begin Page Content Body -->
        <div id="contenido" class="container-fluid">
          <!--------------------------------------mensajes de los modales ---------------------------------------------------->

          <div id="notificaciones" class="row align-items-center justify-content-center vh-50 w-100">
            <!-- lo cambiamos pa proba -->

          </div>

        </div>
        <!-- /.container-fluid -->


        <!-- End of Main Content -->
      </div>

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Renta Bike 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('js/sb-admin-2.min.js') ?>"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url('vendor/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?php echo base_url('vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url('js/demo/datatables-demo.js') ?>"></script>

  <script src="<?php echo base_url('ajax/nuevo-alquiler.js') ?>"></script>
  <script src="<?php echo base_url('ajax/realizar-devolucion.js') ?>"></script>
  <script src="<?php echo base_url('ajax/confirmar-alquiler.js') ?>"></script>


  <script src="<?php echo base_url('ajax/alquileres-concretados.js') ?>"></script>

  <script src="<?php echo base_url('ajax/credito-multas-cliente.js') ?>"></script>
  <script src="<?php echo base_url('ajax/calificar-punto-ed.js') ?>"></script>
  <script src="<?php echo base_url('ajax/buscar-punto-ed.js') ?>"></script>
  <script src="<?php echo base_url('ajax/api-map.js') ?>"></script>
  <script src="<?php echo base_url('ajax/modificar-usuario.js') ?>"></script>
  <script src="<?php echo base_url('ajax/anular-alquiler.js') ?>"></script>
  <script src="<?php echo base_url('ajax/reportar-alquiler.js') ?>"></script>
  <script src="<?php echo base_url('ajax/baja-usuario.js') ?>"></script>
  <script src="<?php echo base_url('ajax/modales.js') ?>"></script>

</body>

</html>