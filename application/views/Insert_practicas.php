<div>
    <!-- Nos traemos los datos de alumno, empresa, empleado, tutor_centro-->
    <?php $alumno = $this->alumno; ?>
    <?php $empresa = $this->empresa; ?>
    <?php $empleado = $this->empleado; ?>
    <?php $tutor = $this->tutor; ?>
    <div class="row d-flex align-content-center justify-content-end">
        <div class="col-sm-1">
            <button class="btn btn-danger btn_exit" type="button" onclick="ir_practicas_view()"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
    <form id="insert_practica">

        <div class="row">
            <div class="col-sm-1 offset-2 mt-3">
                <label for="idAlumno">Alumno: </label>
            </div>
            <div class="col-sm-7  mt-3">
                <select class="form-control" name="idAlumno" <?php echo count($alumno) == 0 ? 'id="alu_vacio"' : 'id="idAlumno"' ?>>
                    <?php if (count($alumno) == 0) { ?>
                        <option value="N/A">NO HAY ALUMNOS! PULSA PARA AÑADIR!</option>
                    <?php } else { ?>
                        <?php foreach ($alumno as $al) { ?>
                            <option value="<?php echo $al['id'] ?>"><?php echo $al['nombre'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-1 offset-2 mt-3">
                <label for="idEmpresa">Empresa: </label>
            </div>
            <div class="col-sm-7  mt-3">
                <select class="form-control" name="idEmpresa" <?php echo count($empresa) == 0 ? 'id="emp_vacia"' : 'id="idEmpresa"' ?>>
                    <?php if (count($empresa) == 0) { ?>
                        <option value="N/A">NO HAY EMPRESAS! PULSA PARA AÑADIR!</option>
                    <?php } else { ?>
                        <?php foreach ($empresa as $emp) { ?>
                            <option value="<?php echo $emp['id'] ?>"><?php echo $emp['nombre'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-1 offset-2 mt-3">
                <label for="sede">Sede: </label>
            </div>
            <div class="col-sm-7 mt-3">
                <select class="form-control" name="sede" id="sede">
                    <?php
                    foreach ($empresa as $key => $emp) {
                        //Separo el string direcciones en cada & y lo añado a un array de strings
                        $res_direcciones[$key] = explode('&', $emp['direcciones']);
                    }

                    //Vuelvo a separar cada valor del array por cada = y así obtener su valor original y meto cada uno en el array $array_direcciones (quito los vacíos)
                    $count = 1;
                    $array_direcciones = array();
                    foreach ($res_direcciones as $key => $rd) {
                        if ($rd != '') {
                            foreach ($rd as $key => $sede) {
                                if ($key != 0) {
                                    $index = strval($count);
                                    $valor = explode('=', $sede);
                                    $count++;
                                }
                                foreach ($valor as $val) {
                                    $array_direcciones['d' . $index] = $valor[1];
                                }
                            }
                        }
                    }

                    //Pinto los valores
                    if (count($array_direcciones) > 0) {
                        foreach ($array_direcciones as $dir) {
                    ?>
                            <option value="<?php echo $dir ?>"><?php echo $dir ?></option>
                        <?php
                        }
                    } else {
                        ?>
                        <option value="Sin Sede">Sin Sedes</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-1 offset-2 mt-3">
                <label for="idEmpleado">Empleado: </label>
            </div>
            <div class="col-sm-7  mt-3">
                <select class="form-control" name="idEmpleado" <?php echo count($empleado) == 0 ? 'id="empl_vacio"' : 'id="idEmpleado"' ?>>
                    <?php if (count($empleado) == 0) { ?>
                        <option value="N/A">NO HAY EMPLEADOS! PULSA PARA AÑADIR!</option>
                    <?php } else { ?>
                        <?php foreach ($empleado as $empl) { ?>
                            <option value="<?php echo $empl['id'] ?>"><?php echo $empl['nombre'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-1 offset-2 mt-3">
                <label for="idTutor">Tutor Centro: </label>
            </div>
            <div class="col-sm-7  mt-3">
                <select class="form-control" name="idTutor" <?php echo count($tutor) == 0 ? 'id="tut_vacio"' : 'id="idTutor"' ?>>
                    <?php if (count($tutor) == 0) { ?>
                        <option value="N/A">NO HAY TUTORES! PULSA PARA AÑADIR!</option>
                    <?php } else { ?>
                        <?php foreach ($tutor as $tut) { ?>
                            <option value="<?php echo $tut['id'] ?>"><?php echo $tut['nombre'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
        </div>

        <div class="row d-flex align-items-center">
            <div class="col-sm-2 d-flex align-items-center offset-3 mt-3 check_label">
                <input class="check_practica" id="check_activo" type="checkbox">
                <label for="activo" style="margin:0">¿Alta en Séneca?</label>
            </div>
        </div>

        <div class="row d-flex align-items-center">
            <div class="col-sm-1 offset-2 mt-3">
                <label for="fecha_incorporacion" style="font-size: 14px">Fecha Incorporación:</label>
            </div>
            <div class="col-sm-2 mt-3">
                <input type="date" class="form-control" name="fecha_incorporacion" />
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2 offset-5 mt-3 mb-3 d-flex justify-content-center">
                <button class="btn btn-success btn_add" type="button" onclick="add_practica()">Añadir</button>
            </div>
        </div>
    </form>
</div>

<script>
    //Evento que redirige a la página de empresas al pulsar
    $('#alu_vacio').click(function() {
        ir_alumno_view();
    });
    //Evento que redirige a la página de empresas al pulsar
    $('#emp_vacia').click(function() {
        ir_empresa_view();
    });
    //Evento que redirige a la página de empresas al pulsar
    $('#empl_vacio').click(function() {
        ir_empleado_view();
    });
    //Evento que redirige a la página de empresas al pulsar
    $('#tut_vacio').click(function() {
        ir_tutor_centro_view();
    });
</script>