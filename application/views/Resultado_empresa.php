<table class="table table-striped">
    <thead class="thead-dark">
        <th>Id</th>
        <th>Nombre</th>
        <th>CIF</th>
        <th>Sedes</th>
        <th></th>
    </thead>
    <tbody>
        <?php
        foreach ($this->emp as $emp) { ?>
            <tr>
                <td><?php echo $emp['id'] ?></td>
                <td><?php echo $emp['nombre'] ?></td>
                <td><?php echo $emp['cif'] ?></td>
                <td><?php
                    //Separo el string direcciones en cada & y lo añado a un array de strings
                    $res_direcciones = explode('&', $emp['direcciones']);

                    //Vuelvo a separar cada valor del array por cada = y así obtener su valor original y meto cada uno en el array $array_direcciones (quito los vacíos)
                    $count = 1;
                    $array_direcciones = array();
                    foreach ($res_direcciones as $rd) {
                        if ($rd != '') {
                            $index = strval($count);
                            $valor = explode('=', $rd);
                            $array_direcciones['d' . $index] = $valor[1];
                            $count++;
                        }
                    }

                    //Pinto los valores
                    foreach ($array_direcciones as $dir) {
                        echo $dir . '<br>';
                    }
                    ?>
                <td class="d-flex justify-content-end tools_res">
                    <button class="btn btn-warning" title="Modificar" onclick="carga_modify_empresa(<?php echo $emp['id'] ?>)"><i class="fa-solid fa-note-sticky"></i></button>
                    <button class="btn btn-danger" title="Eliminar" onclick="delete_empresa(<?php echo $emp['id'] ?>)"><i class="fa-solid fa-eraser"></i></button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>