<script src="<?php echo base_url('ajax/listarMultasCreditos.js') ?>"></script>
<div>
<form id="formulario">
  <div>
    <label for="exampleInputPassword1">Ingrese dni del cliente</label>
    <input type="text" class="form-control" name="dniCliente">
    <span>Ej: 12345678</span>
  </div>
  <button type="submit" class="btn btn-primary">Buscar</button>
</form>
</div>
<div>
<label for="exampleInputPassword1">Nombre y apellido</label>
<?php
$table = new \CodeIgniter\View\Table();

$data = [
        ['Name', 'Color', 'Size'],
        ['Fred', 'Blue',  'Small'],
        ['Mary', 'Red',   'Large'],
        ['John', 'Green', 'Medium'],
];
$template = [
  'table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="mytable">'
];

$table->setTemplate($template);

echo $table->generate($data);?>
</div>
