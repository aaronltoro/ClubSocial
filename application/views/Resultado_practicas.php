<table class="table table-striped">
    <thead class="thead-dark">
        <th>Alumno</th>
        <th>Empresa</th>
        <th>Sede</th>
        <th>Empleado</th>
        <th>Tutor Centro</th>
        <th>Séneca</th>
        <th>Fecha Incorporación</th>
        <th>Curso Escolar</th>
        <th>
            <div class="d-flex justify-content-end align-items-end"><button class="btn btn-success btn_export" type="button" onclick="export_practicas()" title="Exportar a Excel"><i class="fa-solid fa-file-excel"></i></button></div>
        </th>
    </thead>
    <tbody>
        <?php
        foreach ($this->prac as $prac) { ?>
            <tr>
                <td><?php echo $prac['id_alumno'] ?></td>
                <td><?php echo $prac['id_empresa'] ?></td>
                <td><?php echo $prac['sede'] ?></td>
                <td><?php echo $prac['id_empleado'] ?></td>
                <td><?php echo $prac['id_tutor_centro'] ?></td>
                <td><?php echo ($prac['seneca'] == 1) ? 'Sí' : 'No' ?></td>
                <td><?php echo $prac['fecha_incorporacion'] ?></td>
                <td><?php echo $prac['curso_escolar'] ?></td>

                <td class="d-flex justify-content-end tools_res">
                    <button class="btn btn-warning" type="button" title="Modificar" onclick="carga_modify_practicas(<?php echo $prac['id'] ?>,'<?php echo $this->filtro_modal ?>')"><i class="fa-solid fa-note-sticky"></i></button>
                    <button class="btn btn-danger" type="button" title="Eliminar" onclick="delete_practica(<?php echo $prac['id'] ?>)"><i class="fa-solid fa-eraser"></i></button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
