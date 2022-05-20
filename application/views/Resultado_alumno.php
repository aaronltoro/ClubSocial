<table class="table table-striped">
    <thead class="thead-dark">
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>E-Mail</th>
        <th>Ciclo</th>
        <th>Curso Escolar</th>
        <th>
        <div class="d-flex justify-content-end align-items-end"><button class="btn btn-success btn_export" type="button" onclick="export_alumnos()" title="Exportar a Excel"><i class="fa-solid fa-file-excel"></i></button></div>        </th>
    </thead>
    <tbody>
        <?php
        foreach ($this->alumno as $alumno) { ?>
            <tr>
                <td><?php echo $alumno['nombre'] ?></td>
                <td><?php echo $alumno['telefono'] ?></td>
                <td><?php echo $alumno['correo'] ?></td>
                <td><?php echo $alumno['id_ciclo'] ?></td>
                <td><?php echo $alumno['curso_escolar'] ?></td>
                <td class="d-flex justify-content-end tools_res">
                    <button class="btn btn-warning" title="Modificar" onclick="carga_modify_alumno(<?php echo $alumno['id'] ?>)"><i class="fa-solid fa-note-sticky"></i></button>
                    <button class="btn btn-danger" title="Eliminar" onclick="delete_alumno(<?php echo $alumno['id'] ?>)"><i class="fa-solid fa-eraser"></i></button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>