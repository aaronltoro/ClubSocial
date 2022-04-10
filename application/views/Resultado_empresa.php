<table class="table table-striped">
    <thead class="thead-dark">
        <th>Id</th>
        <th>Nombre</th>
        <th>CIF</th>
        <th>Dirección</th>
        <th></th>
    </thead>
    <tbody>
        <?php
        foreach ($this->emp as $emp) { ?>
            <tr>
                <td><?php echo $emp['id'] ?></td>
                <td><?php echo $emp['nombre'] ?></td>
                <td><?php echo $emp['cif'] ?></td>
                <td><?php echo $emp['direccion'] ?></td>
                <td class="d-flex justify-content-end tools_res">
                    <button class="btn btn-warning" title="Modificar" onclick="carga_modify_empresa(<?php echo $emp['id'] ?>)"><i class="fa-solid fa-note-sticky"></i></button>
                    <button class="btn btn-danger" title="Eliminar" onclick="delete_empresa(<?php echo $emp['id'] ?>)"><i class="fa-solid fa-eraser"></i></button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>