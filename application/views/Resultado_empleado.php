<table class="table table-striped">
    <thead class="thead-dark">
        <th>Nombre</th>
        <th>DNI</th>
        <th>Teléfono</th>
        <th>E-Mail</th>
        <th>Empresa</th>
        <th>Tipo</th>
        <th>
            <div class="d-flex justify-content-end align-items-end"><button class="btn btn-success btn_export" type="button" onclick="" title="Exportar a Excel"><i class="fa-solid fa-file-excel"></i></button></div>
        </th>
    </thead>
    <tbody>
        <?php
        foreach ($this->emp as $emp) { ?>
            <tr>
                <td><?php echo $emp['nombre'] ?></td>
                <td><?php echo $emp['dni'] ?></td>
                <td><?php echo $emp['telefono'] ?></td>
                <td><?php echo $emp['correo'] ?></td>
                <td><?php echo $emp['id_empresa'] ?></td>
                <td><?php echo $emp['id_tipo'] ?></td>

                <td class="d-flex justify-content-end tools_res">
                    <button class="btn btn-warning" type="button" title="Modificar" onclick="carga_modify_empleado(<?php echo $emp['id'] ?>)"><i class="fa-solid fa-note-sticky"></i></button>
                    <button class="btn btn-danger" type="button" title="Eliminar" onclick="delete_empleado(<?php echo $emp['id'] ?>)"><i class="fa-solid fa-eraser"></i></button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>