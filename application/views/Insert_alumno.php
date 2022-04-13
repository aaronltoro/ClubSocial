<div>
    <form id="insert_alumno">
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="text" name="nombre" placeholder="Nombre">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="number" name="telefono" placeholder="Telefono">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="email" name="correo" placeholder="Correo">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-2 mt-3">
            <select class="form-control" name="ciclo" id="ciclo">
                    <option value="DAM">DAM</option>
                    <option value="DAW">DAW</option>
                    <option value="ASIR">ASIR</option>
            </select>
                
            </div>
        </div><div class="row">
            <div class="col-sm-8 offset-2 mt-3">
                <input class="form-control" type="text" name="curso" placeholder="Curso Escolar">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 offset-5 mt-3 mb-3 d-flex justify-content-center">
                <button class="btn btn-success btn_add" type="button" onclick="add_alumno()">Añadir</button>
            </div>
        </div>
    </form>
</div>