<h2>Calificar Punto de Entrega</h2>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop"></button>
<div>
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Calificar atención del punto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="false">&times;</span>
          </button>
        </div>
        <form method="POST" class="user" action="<?php echo base_url(); ?>/CalificacionController/calificar">
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Calificación del 1 al 5 (1 muy malo, 5 excelente)</label><br>
              <input id="radio1" type="radio" name="estrellas" value="1" required><label for="radio1">1</label>
              <input id="radio2" type="radio" name="estrellas" value="2" required><label for="radio2">2</label>
              <input id="radio3" type="radio" name="estrellas" value="3" required><label for="radio3">3</label>
              <input id="radio4" type="radio" name="estrellas" value="4" required><label for="radio4">4</label>
              <input id="radio5" type="radio" name="estrellas" value="5" required><label for="radio5">5</label>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Comentarios (opcional)</label>
              <input type="input" name="comentario" class="form-control form-control-user">

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Enviar calificación</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>