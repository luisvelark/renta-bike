<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop"></button>
<div>
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Calificar punto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form-calificar">
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Calificación (del 1 al 5)</label><br>
              <input id="radio1" type="radio" name="estrellas" value="1"><label for="radio1">1</label>
              <input id="radio2" type="radio" name="estrellas" value="2"><label for="radio2">2</label>
              <input id="radio3" type="radio" name="estrellas" value="3" checked><label for="radio3">3</label>
              <input id="radio4" type="radio" name="estrellas" value="4"><label for="radio4">4</label>
              <input id="radio5" type="radio" name="estrellas" value="5"><label for="radio5">5</label>
              <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> -->
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Comentarios</label>
              <input type="input" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Enviar calificación</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- <script>
  var contador;

  function calificar(item) {
    console.log(item);
    contador = item.id[0];
    let nombre = item.id.substring(1);
    for (let i = 0; i < 5; i++) {
      if (i < contador) {
        document.getElementById((i + 1) + nombre).style.color = "orange";
      }
    }
  }
</script>

<span class="fa fa-star" onclick="calificar(this);" style="cursor:pointer;" id="1estrella"></span>
<span class="fa fa-star" onclick="calificar(this);" style="cursor:pointer;" id="2estrella"></span>
<span class="fa fa-star" onclick="calificar(this);" style="cursor:pointer;" id="3estrella"></span>
<span class="fa fa-star" onclick="calificar(this);" style="cursor:pointer;" id="4estrella"></span>
<span class="fa fa-star" onclick="calificar(this);" style="cursor:pointer;" id="5estrella"></span> -->