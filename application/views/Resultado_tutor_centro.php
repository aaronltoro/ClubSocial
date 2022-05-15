<table class="table table-striped">
    <thead class="thead-dark">
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>E-Mail</th>
        <th>Activo</th>
        <th>
            <div class="d-flex justify-content-end align-items-end"><button class="btn btn-success btn_export" type="button" onclick="" title="Exportar a Excel"><i class="fa-solid fa-file-excel"></i></button></div>
        </th>
    </thead>
    <tbody>
        <?php
        foreach ($this->tutor_centro as $tutor_centro) { ?>
            <tr>
                <td><?php echo $tutor_centro['nombre'] ?></td>
                <td><?php echo $tutor_centro['telefono'] ?></td>
                <td><?php echo $tutor_centro['correo'] ?></td>
                <td><?php echo ($tutor_centro['activo'] == 1) ? 'Sí' : 'No' ?></td>
                <td class="d-flex justify-content-end tools_res">
                    <button class="btn btn-warning" title="Modificar" onclick="carga_modify_tutor_centro(<?php echo $tutor_centro['id'] ?>)"><i class="fa-solid fa-note-sticky"></i></button>
                    <button class="btn btn-danger" title="Eliminar" onclick="delete_tutor_centro(<?php echo $tutor_centro['id'] ?>)"><i class="fa-solid fa-eraser"></i></button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>