<div>
    <?php $alumno = $this->alumno; ?>
    <div class="row d-flex align-content-center justify-content-end">
        <div class="col-sm-1">
            <button class="btn btn-danger btn_exit" type="button" onclick="ir_alumno_view()"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
    <form id="modify_alumno">
        <div class="row item item_mod">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="nombre">Nombre</label>
                <input class="form-control" type="text" name="nombre" value="<?php echo $alumno[0]['nombre'] ?>">
            </div>
        </div>
        <div class="row item item_mod">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="telefono">Tlf</label>
                <input class="form-control" type="text" name="telefono" value="<?php echo $alumno[0]['telefono'] ?>">
            </div>
        </div>
        <div class="row item item_mod">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="correo">E-Mail</label>
                <input class="form-control" type="email" name="correo" value="<?php echo $alumno[0]['correo'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <select class="form-control" name="ciclo" id="ciclo">
                    <?php if ($alumno[0]['ciclo'] == 'DAM') : ?>

                        <option value="DAM" selected>DAM</option>
                        <option value="DAW">DAW</option>
                        <option value="ASIR">ASIR</option>
                    <?php endif; ?>

                    <?php if ($alumno[0]['ciclo'] == 'DAW') : ?>
                        <option value="DAM">DAM</option>
                        <option value="DAW" selected>DAW</option>
                        <option value="ASIR">ASIR</option>
                    <?php endif; ?>

                    <?php if ($alumno[0]['ciclo'] == 'ASIR') : ?>
                        <option value="DAM">DAM</option>
                        <option value="DAW">DAW</option>
                        <option value="ASIR" selected>ASIR</option>
                    <?php endif; ?>

                </select>
            </div>
        </div>
        <div class="row item item_mod">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="curso">Curso</label>
                <input class="form-control" type="text" name="curso" value="<?php echo $alumno[0]['curso_escolar'] ?>">
            </div>
        </div>


        <div class="row">
            <div class="col-sm-2 offset-5 mt-3 mb-3 d-flex justify-content-center">
                <button class="btn btn-warning btn_add" type="button" onclick="modify_alumno(<?php echo $alumno[0]['id'] ?>)">Modificar</button>
            </div>
        </div>
    </form>
</div>

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