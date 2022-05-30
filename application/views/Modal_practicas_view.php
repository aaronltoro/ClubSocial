<div class="container" id="principal">
    <form id="resultadoModal">
        <div class="row filtering d-flex justify-content-between align-items-start">
            <div class="col-sm-1 mt-2">
                <img src="public/img/CEU.png" alt="Logo CEU" width="300px" height="160px">
            </div>
            <div class="col-sm-1 offset-10 mt-2 d-flex ">
                <button class="btn btn-info" onclick="ir_principal_view()">Volver</button>
            </div>
        </div>
        <div class="row filtering">
            <div class="col-sm-5 mt-3">
                <h1>Selecciona Curso</h1>

                <select name="filtro_curso" id="resultado">
                </select>

            </div>
        </div>
        <button class="btn btn-primary" type="button" id="btnModal">Buscar</button>
    </form>
</div>

<script>
    var btn = document.getElementById("btnModal");
    btn.addEventListener("click", function() {

        var curso = $('#resultadoModal').serialize();
        ir_practicas_view(curso);
    })
</script>