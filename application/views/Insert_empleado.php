<div>
    <!-- Nos traemos los datos de tipo de empleado y empresa-->
    <?php $empresa = $this->empresa; ?>
    <?php $tipo_empleado = $this->tipo_empleado; ?>
    <div class="row d-flex align-content-center justify-content-end">
        <div class="col-sm-1">
            <button class="btn btn-danger btn_exit" type="button" onclick="ir_empleado_view()"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
    <form id="insert_empleado">
        <div class="row item item_ins">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="nombre">Nombre</label>
                <input class="form-control" type="text" name="nombre">
            </div>
        </div>
        <div class="row item item_ins">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="dni">DNI</label>
                <input class="form-control" type="text" name="dni">
            </div>
        </div>
        <div class="row item item_ins">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="correo">E-Mail</label>
                <input class="form-control" type="text" name="correo">
            </div>
        </div>
        <div class="row item item_ins">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="telefono">Tlf</label>
                <input class="form-control" type="text" name="telefono">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1 offset-2 mt-3">
                <label for="idEmpresa">Empresa: </label>
            </div>
            <div class="col-sm-7  mt-3">
                <select class="form-control" name="idEmpresa" id="idEmpresa">
                    <?php foreach ($empresa as $emp) { ?>
                        <option value="<?php echo $emp['id'] ?>"><?php echo $emp['nombre'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1 offset-2 mt-3">
                <label for="idEmpresa">Tipo: </label>
            </div>
            <div class="col-sm-7  mt-3">
                <select class="form-control" name="idTipo" id="idTipo">
                    <?php foreach ($tipo_empleado as $t_e) { ?>
                        <option value="<?php echo $t_e['id'] ?>"><?php echo $t_e['nombre'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 offset-5 mt-3 mb-3 d-flex justify-content-center">
                <button class="btn btn-success btn_add" type="button" onclick="add_empleado()">Añadir</button>
            </div>
        </div>
    </form>
</div>

<!--Este script es necesario, sino peta mucho UwU-->
<script>
    // console.log($("#insert_empleado").serialize());
</script>
<script>
    //Script para los label de los inputs
    $(document).ready(function() {
        $('input').each(function() {
            $(this).on('focus', function() {
                $(this).parent('.wrapper').addClass('active');
            });
            $(this).on('blur', function() {
                if ($(this).val().length === 0) {
                    $(this).parent('.wrapper').removeClass('active');
                }
            });
            if ($(this).val() !== '') $(this).parent('.wrapper').addClass('active');
        });
    });
</script>