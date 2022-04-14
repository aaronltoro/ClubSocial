<div>
    <?php $empresa = $this->empresa; ?>
    <?php $tipo_empleado = $this->tipo_empleado; ?>
    <form id="insert_empleado">
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="text" name="nombre" placeholder="Nombre">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="text" name="dni" placeholder="DNI">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="text" name="correo" placeholder="Correo">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="text" name="telefono" placeholder="Telefono">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1 offset-2 mt-3"> 
                <label for="idEmpresa">Empresa: </label>
            </div>
            <div class="col-sm-7  mt-3">
                <select class="form-control" name="idEmpresa" id="idEmpresa">  
                    <?php  foreach ($empresa as $emp) {?>
                        <option value="<?php echo $emp['id']?>"><?php echo $emp['nombre']?></option>
                    <?php }?> 
                </select>
            </div>
        </div>

        <div class="row">
        <div class="col-sm-1 offset-2 mt-3"> 
                <label for="idEmpresa">Tipo: </label>
            </div>
            <div class="col-sm-7  mt-3">
                <select class="form-control" name="idTipo" id="idTipo">
                    <?php  foreach ($tipo_empleado as $t_e) {?>
                        <option value="<?php echo $t_e['id']?>"><?php echo $t_e['nombre']?></option>
                    <?php }?>       
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 offset-5 mt-3 mb-3 d-flex justify-content-center">
               <button class="btn btn-success btn_add" type="button" onclick="add_empleado()">Añadir</button>          
            </div>
        </div>
    </form>
</div>

<!--Este script es necesaario, sino peta mucho UwU-->
<script>
    
   // console.log($("#insert_empleado").serialize());
</script>
