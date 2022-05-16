<div>
    <?php $alumno = $this->alumno; ?>
    <?php $ciclos = $this->ciclo; ?>

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
            <div class="col-sm-4 offset-2 mt-3">
                <select class="form-control" name="ciclo" id="ciclo">
                    <?php foreach ($ciclos as $c) : ?>
                        <option value="<?php echo $c['id'] ?>" title="<?php echo $c['nombre_largo'] ?>" <?php echo ($alumno[0]['id_ciclo'] == $c["id"]) ? 'selected' : '' ?>><?php echo $c['nombre_corto'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-3 mt-3">
                <button id="añadirCiclo" class="btn btn-warning" type="button">Nuevo Ciclo</button>
            </div>
        </div>

        <div class="row">
            <!--Div de resultado donde se van a escribir los botones-->
            <div class="col-sm-12 mt-3" id='res'></div>
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
    //Script para añadir un nuevo ciclo
    document.getElementById("añadirCiclo").addEventListener('click', pinta_inputs);

    function pinta_inputs() {

        //Si ya están pintados los inputs y se vuelve a pulsar el botón estos se quitan
        if (document.getElementById("res").innerHTML == '') {
            //Pintamos los inputs para escribir los datos del nuevo ciclo
            res = '<div class="row">';
            res += '<div class="col-sm-4 offset-2 mb-2">';
            res += '<input class="form-control" type="text" name="nombreCorto" placeholder="Nombre Corto ">';
            res += '</div>';
            res += '</div>';
            res += '<div class="row">';
            res += '<div class="col-sm-4 offset-2 mb-2">';
            res += '<input class="form-control" type="text" name="nombreLargo" placeholder="Nombre Largo ">';
            res += '</div>';
            res += '<div class="col-sm-1 mb-2" >';
            res += '<button class="btn btn-warning btn_add" onclick="add_ciclo_modify(<?php echo $alumno[0]['id'] ?>)" type="button">Confirmar</button>'
            res += '</div>';
            res += '</div>';
        } else {
            res = '';
        }

        document.getElementById("res").innerHTML = res;
    }

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