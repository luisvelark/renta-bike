<div class="container py-4" style="background: white;">
    <h1>Modificar perfil</h1>
    <label> Si realizas alguna modificación, se cerrará sesion para que no haya inconvenientes</label> <br>
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-1 d-none d-lg-block bg-registrar-image"></div>
            <div class="col-lg-6">
                <div class="p-5">
                    <div class="text-center">
                    </div>
                    <form class="user" id="idFormModificar">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="nombre" name="nombre" placeholder="Nombre" autofocus value="<?php if (isset($usuario)) {
                                                                                                                                                                echo $usuario['nombre'];
                                                                                                                                                            } ?>" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="apellido" name="apellido" placeholder="Apellido" value="<?php if (isset($usuario)) {
                                                                                                                                                            echo $usuario['apellido'];
                                                                                                                                                        } ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="number" class="form-control form-control-user" id="dni" name="dni" readOnly placeholder="Dni" value="<?php if (isset($usuario)) {
                                                                                                                                                echo $usuario['dni'];
                                                                                                                                            } ?>" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-user" id="cuil" name="cuil" readOnly placeholder="Cuil" value="<?php if (isset($usuario)) {
                                                                                                                                                echo $usuario['cuil-cuit'];
                                                                                                                                            } ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="domicilio" name="domicilio" placeholder="Domicilio" value="<?php if (isset($usuario)) {
                                                                                                                                                            echo $usuario['domicilio'];
                                                                                                                                                        } ?>" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="date" class="form-control form-control-user" id="fecha" name="fecha" placeholder="Fecha de nacimiento" value="<?php if (isset($usuario)) {
                                                                                                                                                                echo $usuario['fechaNacimiento'];
                                                                                                                                                            } ?>" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-user" id="telefono" name="telefono" placeholder="Teléfono" value="<?php if (isset($usuario)) {
                                                                                                                                                            echo $usuario['telefono'];
                                                                                                                                                        } ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="correo" name="correo" placeholder="Correo electrónico" value="<?php if (isset($usuario)) {
                                                                                                                                                                echo $usuario['correo'];
                                                                                                                                                            } ?>" required>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="contraseña" name="contraseña" placeholder="Contraseña" value="<?php if (isset($usuario)) {
                                                                                                                                                                    echo $usuario['contraseña'];
                                                                                                                                                                } ?>" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="rcontraseña" name="rcontraseña" placeholder="Repetir contraseña" value="<?php if (isset($usuario)) {
                                                                                                                                                                                echo $usuario['contraseña'];
                                                                                                                                                                            } ?>" required>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-user btn-block" type="submit">Actualizar</button>
                        </a>
                        <hr>

                    </form>
                    
                        <div  id="divRespuesta"></div>
                </div>
            </div>
        </div>
    </div>
</div>