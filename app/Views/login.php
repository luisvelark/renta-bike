<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Renta Bike - Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('/css/css.css') ?>" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('css/sb-admin-2.css') ?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">
      
        <div class="card o-hidden border-0 shadow-lg my-5">
         
        <h2 class="h2 text-gray-900 mb-4" style="margin: 0 auto;">Bienvenido a Renta Bike <i class="fas fa-bicycle"></i></h2>
        
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image">
                <img class="login-image" src="<?php echo base_url('/img/fondo.jpg') ?>" alt="">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">¡Inicia sesión para empezar!</h1>
                    <div id= "divLogin"class="text-center">
                    <?php if (isset($msj)){
                       echo '<div class= "alert alert-success">';
                       echo $msj;
                       echo '</div>';
                      
                    } ?>
                    <?php if (isset($_GET['exit'])){
                      echo '<div class= "alert alert-success">';
                      echo 'Te has dado de baja correctamente';
                      echo '</div>';
                    } ?>
                    <br>
                  </div>
                  </div>

                  <form class="user" method="POST" action="<?php echo base_url(); ?>/UsuarioController/ingresarAlSistema">

                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp"  autofocus placeholder="Ingrese un correo..." required>
                    
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Contraseña" required>
                    </div>

                    <button class="btn btn-primary btn-user btn-block" type="submit">Ingresar</button>
                    <hr>
                    <?php if (isset($validation)) { ?>
                      <div class="alert alert-danger">
                        <?php echo $validation->listErrors(); ?>
                      </div>
                    <?php } ?>
                    <?php if (isset($error)) { ?>
                      <div class="alert alert-danger">
                        <?php echo $error; ?>
                      </div>
                    <?php } ?>


                  </form>
                  <hr>

                  <div class="text-center">
                    <a class="medium" href="<?php echo base_url('GestionController/mostrarRegistroUsuario') ?>">
                    <i class="fas fa-user-plus"></i>
                    <span>¡Create una cuenta!</span></a>
                  </div>
                  <hr>
                  <div class="text-center">

                    <a class="medium" download="Manual_Renta_Bike.pdf" href="<?php echo base_url('/download/Manual_Renta_Bike.pdf')?>">
                    <i class="far fa-file-alt"></i>
                    <span>Descargar manual de usuario</span></a>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
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
  <script src="<?php echo base_url('js/sb-admin-2.js') ?>"></script>


</body>

</html>