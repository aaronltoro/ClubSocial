<div>
<?php $emp = $this->emp; ?>
    <form id="modify_empresa">
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="text" name="nombre" placeholder="Nombre" value="<?php echo $emp[0]['nombre'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="text" name="cif" placeholder="CIF" value="<?php echo $emp[0]['cif'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="text" name="direccion" placeholder="Dirección" value="<?php echo $emp[0]['direccion'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 offset-5 mt-3 mb-3 d-flex justify-content-center">
                <button class="btn btn-warning btn_add" type="button" onclick="modify_empresa(<?php echo $emp[0]['id'] ?>)">Modificar</button>
            </div>
        </div>
    </form>
</div>