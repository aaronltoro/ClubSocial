<div>
    <form id="insert_tutor_centro">
        <div class="row item item_ins">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="nombre">Nombre</label>
                <input class="form-control" type="text" name="nombre">
            </div>
        </div>
        <div class="row item item_ins">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="telefono">Tlf</label>
                <input class="form-control" type="text" name="telefono">
            </div>
        </div>
        <div class="row item item_ins">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="correo">E-Mail</label>
                <input class="form-control" type="email" name="correo">
            </div>
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-sm-2 d-flex align-items-center offset-2 mt-3 check_label">
                <input class="check_tutor" id="check_activo" type="checkbox" checked>
                <label for="activo" style="margin:0">¿Activo?</label>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 offset-5 mt-3 mb-3 d-flex justify-content-center">
                <button class="btn btn-success btn_add" type="button" onclick="add_tutor_centro()">Añadir</button>
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