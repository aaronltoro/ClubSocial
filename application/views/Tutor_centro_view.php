<div class="container" id="principal">
	<form id="filtros_tutor_centro" method="post">
		<div class="row filtering d-flex justify-content-between align-items-start">
			<div class="col-sm-1 mt-2">
				<img src="public/img/CEU.png" alt="Logo CEU" width="300px" height="160px">
			</div>
			<div class="col-sm-1 offset-10 mt-2 d-flex ">
				<button class="btn btn-info" onclick="ir_principal_view()">Volver</button>
			</div>
		</div>

		<div class="row filtering">
			<div class="col-sm-5 mt-3">
				<h1>Tutor centro</h1>
			</div>
			<div class="col-sm-2 mt-3 d-flex">
				<button class="btn btn-success ml-auto" type="button" onclick="carga_insert_tutor_centro()"><i class="fa-solid fa-plus"></i> Añadir</button>
			</div>
			<div class="col-sm-2 mt-3">
				<select class="form-control" name="filter_by">
					<option value="-1">- Filtrar por -</option>
					<option value="n">Nombre</option>
				</select>
			</div>
			<div class="col-sm-3 mt-3">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="- Filtro -" name="filter">
					<div class="input-group-append">
						<button class="btn btn-outline-primary" type="button" onclick="carga_filtros_tutor_centro()"><i class="fa-solid fa-magnifying-glass"></i></button>
					</div>
				</div>
			</div>
		</div>
	</form>

	<hr>

	<div id="resultado">

	</div>
</div>