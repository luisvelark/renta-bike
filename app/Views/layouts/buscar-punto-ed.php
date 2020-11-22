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
	<title>Renta Bike - Buscar puntos de entrega y devolución</title>
	<link href=" <?php echo base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('/css/css.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">

</head>

<body id="page-top">
	<div id="wrapper">
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-bicycle"></i>
				</div>
				<div class="sidebar-brand-text mx-3">Renta Bike</div>
			</a>
			<hr class="sidebar-divider my-0">
			<hr class="sidebar-divider d-none d-md-block">
			<div class="text-center d-none d-md-inline">
			</div>
		</ul>
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">

				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
					<h1>Mapa interactivo - Puntos de entrega y devolución</h1>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown no-arrow d-sm-none">
						</li>
						<div class="topbar-divider d-none d-sm-block"></div>
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small">
									<?php echo $user_session->nombre . ' ' . $user_session->apellido; ?></span>
								<i class="fas fa-user"></i>
							</a>
						</li>
					</ul>
				</nav>

				<div id="contenido" class="container-fluid">
					<div id="map" style="height: 665px; width: 100%;"></div>
				</div>

			</div>

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
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

	<?php
	for ($i = 0; $i < count($coordenadas); $i++) {
		echo '<input class="coor" id="' . $i . '" type="hidden" value="' . $coordenadas[$i]['lat'] . '/' . $coordenadas[$i]['lng'] . '">';
	}
	?>
	<script src="<?php echo base_url('vendor/jquery/jquery.min.js') ?>"></script>
	<script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
	<script src="<?php echo base_url('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
	<script src="<?php echo base_url('js/sb-admin-2.min.js') ?>"></script>
	<script src="<?php echo base_url('vendor/datatables/jquery.dataTables.min.js') ?>"></script>
	<script src="<?php echo base_url('vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
	<script src="<?php echo base_url('js/demo/datatables-demo.js') ?>"></script>
	<script src="<?php echo base_url('ajax/buscar-punto-ed.js') ?>"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap"></script>
</body>

</html>