<div>
  
<?php $alumno = $this->alumno; ?>

    <form id="modify_alumno">
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="text" name="nombre" placeholder="Nombre" value="<?php echo $alumno[0]['nombre'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="number" name="telefono" placeholder="Telefono" value="<?php echo $alumno[0]['telefono'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="email" name="correo" placeholder="Correo" value="<?php echo $alumno[0]['correo'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">       
                <select class="form-control" name="ciclo" id="ciclo">
                  <?php if($alumno[0]['ciclo']=='DAM'): ?>

                    <option value="DAM" selected>DAM</option>
                    <option value="DAW">DAW</option>
                    <option value="ASIR">ASIR</option>
                    <?php endif;?>

                     <?php if($alumno[0]['ciclo']=='DAW'): ?>
                    <option value="DAM">DAM</option>
                    <option value="DAW" selected>DAW</option>
                    <option value="ASIR">ASIR</option>
                    <?php endif;?>

                    <?php if($alumno[0]['ciclo']=='ASIR'): ?>
                    <option value="DAM">DAM</option>
                    <option value="DAW" >DAW</option>
                    <option value="ASIR" selected>ASIR</option>
                    <?php endif;?>

            </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="text" name="curso" placeholder="curso Escolar" value="<?php echo $alumno[0]['curso_escolar'] ?>">
            </div>
        </div>
   
       
        <div class="row">
            <div class="col-sm-2 offset-5 mt-3 mb-3 d-flex justify-content-center">
                <button class="btn btn-warning btn_add" type="button" onclick="modify_alumno(<?php echo $alumno[0]['id'] ?>)">Modificar</button>
            </div>
        </div>
    </form>
</div>