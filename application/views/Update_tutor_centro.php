<div>

    <?php $tutor_centro = $this->tutor_centro; ?>

    <form id="modify_tutor_centro">
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="text" name="nombre" placeholder="Nombre" value="<?php echo $tutor_centro[0]['nombre'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="number" name="telefono" placeholder="Telefono" value="<?php echo $tutor_centro[0]['telefono'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="email" name="correo" placeholder="Correo" value="<?php echo $tutor_centro[0]['correo'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 offset-5 mt-3 mb-3 d-flex justify-content-center">
                <button class="btn btn-warning btn_add" type="button" onclick="modify_tutor_centro(<?php echo $tutor_centro[0]['id'] ?>)">Modificar</button>
            </div>
        </div>
    </form>
</div>