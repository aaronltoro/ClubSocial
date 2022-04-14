<table class="table table-striped">
    <thead class="thead-dark">
        <th>Id</th>
        <th>Id Empresa</th>
        <th>Id_tipo</th>
        <th>Nombre</th>
        <th>DNI</th>
        <th>Correo</th>
        <th>Telefono</th>
        <th></th>
    </thead>
    <tbody>
        <?php
        foreach ($this->emp as $emp) { ?>
            <tr>
                <td><?php echo $emp['id'] ?></td>
                <td><?php echo $emp['id_empresa'] ?></td>
                <td><?php echo $emp['id_tipo'] ?></td>
                <td><?php echo $emp['nombre'] ?></td>
                <td><?php echo $emp['dni'] ?></td>
                <td><?php echo $emp['correo'] ?></td>
                <td><?php echo $emp['telefono'] ?></td>
                



                <td class="d-flex justify-content-end tools_res">
                    <button class="btn btn-warning"  type="button" title="Modificar" onclick="carga_modify_empleado(<?php echo $emp['id'] ?>)"><i class="fa-solid fa-note-sticky"></i></button>
                    <button class="btn btn-danger"  type="button" title="Eliminar" onclick="delete_empleado(<?php echo $emp['id'] ?>)"><i class="fa-solid fa-eraser"></i></button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>