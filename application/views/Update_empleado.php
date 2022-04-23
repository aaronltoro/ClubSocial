<div>
    <!-- Nos traemos los datos de empleado, tipo de empleado y empresa-->
    <?php $emp = $this->emp; ?>
    <?php $empresa = $this->empresa; ?>
    <?php $tipo_empleado = $this->tipo_empleado; ?>

    <div class="row d-flex align-content-center justify-content-end">
        <div class="col-sm-1">
            <button class="btn btn-danger btn_exit" type="button" onclick="ir_empleado_view()"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>

    <form id="modify_empleado">
        <div class="row item item_mod">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="nombre">Nombre</label>
                <input class="form-control" type="text" name="nombre" value="<?php echo $emp[0]['nombre'] ?>">
            </div>
        </div>
        <div class="row item item_mod">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="dni">DNI</label>
                <input class="form-control" type="text" name="dni" value="<?php echo $emp[0]['dni'] ?>">
            </div>
        </div>
        <div class="row item item_mod">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="correo">E-Mail</label>
                <input class="form-control" type="text" name="correo" value="<?php echo $emp[0]['correo'] ?>">
            </div>
        </div>
        <div class="row item item_mod">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="telefono">Tlf</label>
                <input class="form-control" type="text" name="telefono" value="<?php echo $emp[0]['telefono'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1 offset-2 mt-3">
                <label for="idEmpresa">Empresa: </label>
            </div>
            <div class="col-sm-7  mt-3">
                <!-- Recorreremos todas las empresas para poneras en el select, y la empresa que coincida con la del empleado estara seleccionada-->
                <select class="form-control" name="idEmpresa" id="idEmpresa">
                    <?php foreach ($empresa as $empl) { ?>
                        <option value="<?php echo $empl['id'] ?>" <?php if ($emp[0]['id_empresa'] == $empl['id']) {
                                                                        echo 'selected';
                                                                    } ?>><?php echo $empl['nombre'] ?></option>
                        <!--Cierre foreach-->
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1 offset-2 mt-3">
                <label for="idTipo">Tipo: </label>
            </div>
            <div class="col-sm-7  mt-3">
                <!-- Recorreremos todas los tipos de empleados para poneras en el select, y el tipo que coincida con la del empleado estara seleccionada-->
                <select class="form-control" name="idTipo" id="idTipo">
                    <?php foreach ($tipo_empleado as $t_e) { ?>
                        <option value="<?php echo $t_e['id'] ?>" <?php if ($emp[0]['id_tipo'] == $t_e['id']) {
                                                                        echo 'selected';
                                                                    } ?>><?php echo $t_e['nombre'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 offset-5 mt-3 mb-3 d-flex justify-content-center">
                <button class="btn btn-warning btn_add" type="button" onclick="modify_empleado(<?php echo $emp[0]['id'] ?>)">Modificar</button>
            </div>
        </div>
    </form>
</div>

<!--Este script es necesario, sino peta mucho UwU-->
<script>
    // console.log($("#modify_empleado").serialize());
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