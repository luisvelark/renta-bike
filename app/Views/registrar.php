<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Registrar</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('/css/css.css') ?>" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('css/sb-admin-2.css') ?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-registrar-image">
          <img class="registrar-image" src="<?php echo base_url('/img/bici2.jpg') ?>" alt=""></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">¡Crear una cuenta!</h1>
              </div>
              <form class="user" method="POST" action="<?php echo base_url(); ?>/UsuarioController/registrarUsuario">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="nombre" name="nombre" placeholder="Nombre" autofocus value ="<?php if(isset($nombre)){ echo $nombre; } ?>" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="apellido" name="apellido" placeholder="Apellido" value ="<?php if(isset($apellido)){ echo $apellido; } ?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="number" class="form-control form-control-user" id="dni" name="dni" placeholder="Dni" value ="<?php if(isset($dni)){ echo $dni; } ?>" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="number" class="form-control form-control-user" id="cuil" name="cuil" placeholder="Cuil" value ="<?php if(isset($cuil)){ echo $cuil; } ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="domicilio" name="domicilio" placeholder="Domicilio" value ="<?php if(isset($domicilio)){ echo $domicilio; } ?>" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="date" class="form-control form-control-user" id="fecha" name="fecha" placeholder="Fecha de nacimiento" value ="<?php if(isset($fecha)){ echo $fecha; } ?>" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="number" class="form-control form-control-user" id="telefono" name="telefono" placeholder="Teléfono" value ="<?php if(isset($telefono)){ echo $telefono; } ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="correo" name="correo"placeholder="Correo electrónico" value ="<?php if(isset($correo)){ echo $correo; } ?>" required>
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="contraseña" name="contraseña" placeholder="Contraseña" value ="<?php if(isset($contraseña)){ echo $contraseña; } ?>" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="rcontraseña" name="rcontraseña" placeholder="Repetir contraseña" required>
                  </div>
                </div>
                <button class="btn btn-primary btn-user btn-block" type="submit">Registrarse</button>
                </a>
                <hr>

              </form>
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
                    <div class="text-center">
                <label> *Todos los campos son obligatorios</label>
              </div>
              <div class="text-center">
                <a class="medium" href="<?php echo base_url('LoginController/index') ?>">¿Ya tienes una cuenta? ¡Ingresa!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
<!-- ---------------------------------------------------------------------------------------------->

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('js/sb-admin-2.js') ?>"></script>


</body>

</html>
