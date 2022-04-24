<div>
    <?php $emp = $this->emp; ?>
    <div class="row d-flex align-content-center justify-content-end">
        <div class="col-sm-1">
            <button class="btn btn-danger btn_exit" type="button" onclick="ir_empresa_view()"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
    <form id="modify_empresa">
        <div class="row item item_mod">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="nombre">Nombre</label>
                <input class="form-control" type="text" name="nombre" value="<?php echo $emp[0]['nombre'] ?>">
            </div>
        </div>
        <div class="row item item_mod">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="cif">CIF</label>
                <input class="form-control" type="text" name="cif" value="<?php echo $emp[0]['cif'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 offset-2 mt-3">
                <button type="button" class="btn btn-success" id="btn_modify_empresa" title="Solo 1 nuevo por cada modificación - Máx 7" onclick="add_inpt_direccion()">Añadir Dirección</button>
            </div>
            <div class="col-sm-5 offset-1 mt-3" id='res'>

                <?php
                $direcciones = $emp[0]['direcciones'];

                //Separo el string direcciones en cada & y lo añado a un array de strings
                $arr_dir = explode('&', $direcciones);

                //Vuelvo a separar cada valor del array por cada = y así obtener su valor original y meto cada uno en el array $array_direcciones (quito los vacíos)
                $count = 1;
                $array_direcciones = array();
                foreach ($arr_dir as $ad) {
                    if ($ad != '') {
                        $index = strval($count);
                        $valor = explode('=', $ad);
                        $array_direcciones['d' . $index] = $valor[1];
                        $count++;
                    }
                }

                //Pinto un input por cada valor de dirección que tenga el array
                $count = 1;
                foreach ($array_direcciones as $dir) { ?>
                    <div class="col-sm-12 mb-2 p-0 borrar_sede" id="div_direccion<?php echo $count; ?>">
                        <button class="btn btn-warning" type="button" onclick="add_principal(<?php echo $count ?>,<?php echo $emp[0]['id'] ?>)" title="Principal"><?php if ($count == $emp[0]['principal']) {
                                                                                                        echo '<i class="fa-solid fa-star"></i>';
                                                                                                    } else {
                                                                                                        echo '<i class="fa-regular fa-star"></i>';
                                                                                                    } ?></button>
                        <button class="btn btn-danger" type="button" onclick="eliminar_sede(<?php echo $count; ?>,<?php echo $emp[0]['id'] ?>,<?php echo $emp[0]['principal'] ?>)" title="Eliminar"><i class="fa-solid fa-eraser"></i></button>
                        <input class="form-control" type="text" name="direccion<?php echo $count ?>" placeholder="Dirección <?php echo $count ?>" value="<?php echo $dir ?>">
                    </div>
                <?php $count++;
                } ?>

                <!--Script que pinta un nuevo input cada vez que el usuario pulsa el botón-->
                <script>
                    function add_inpt_direccion() {
                        count = <?php echo $count; ?>;
                        if (count <= 7) {
                            document.getElementById("res").innerHTML += '<div class="col-sm-12 mb-2 p-0 borrar_sede" id="div_direccion<?php echo $count; ?>"><button class="btn btn-danger" type="button" onclick="eliminar_sede(<?php echo $count; ?>,<?php echo $emp[0]['id'] ?>,<?php echo $emp[0]['principal'] ?>)" title="Eliminar"><i class="fa-solid fa-eraser"></i></button><input class="form-control" type="text" name="direccion<?php echo $count; ?>" placeholder="Dirección <?php echo $count; ?>"></div>';
                            document.getElementById('btn_modify_empresa').disabled = true;
                        }
                    }
                </script>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 offset-5 mt-3 mb-3 d-flex justify-content-center">
                <button class="btn btn-warning btn_add" type="button" onclick="modify_empresa(<?php echo $emp[0]['id'] ?>)">Modificar</button>
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