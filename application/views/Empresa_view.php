<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="public/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/main.css">
	<link rel="stylesheet" href="public/fontawesome/css/all.css">
	<script src="public/js/jquery.min.js"></script>
	<script src="public/js/bootstrap.min.js"></script>
	<script src="public/js/main.js"></script>
	<title>Inicio</title>
</head>

<body onload="carga_empresa()">
	<div class="container" id="principal">
		<form id="filtros_empresa" method="post">
			<div class="row filtering">
				<div class="col-sm-1 mt-3">
					<img src="public/img/CEU.jpg" alt="Logo CEU" width="300px" height="150px">
				</div>
				<div class="col-sm-2 offset-9 mt-3 align-self-end d-flex">
					<button class="btn btn-success ml-auto" type="button" onclick="carga_insert_empresa()"><i class="fa-solid fa-plus"></i> Añadir</button>
				</div>
			</div>

			<div class="row filtering">
				<div class="col-sm-7 mt-3">
					<h1>Empresas</h1>
				</div>
				<div class="col-sm-2 mt-3">
					<select class="form-control" name="filter_by">
						<option value="-1">- Filtrar por -</option>
						<option value="n">Nombre</option>
						<option value="c">CIF</option>
					</select>
				</div>
				<div class="col-sm-3 mt-3">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="- Filtro -" name="filter">
						<div class="input-group-append">
							<button class="btn btn-outline-primary" type="button" onclick="carga_filtros_empresa()"><i class="fa-solid fa-magnifying-glass"></i></button>
						</div>
					</div>
				</div>
			</div>
		</form>

		<hr>

		<div id="resultado">

		</div>
	</div>
	<script>
		//Defino como constante la url base de codeigniter
		BASE_URL = '<?php echo base_url() ?>';
	</script>
</body>

</html>