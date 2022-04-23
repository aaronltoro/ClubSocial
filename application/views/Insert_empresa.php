<div>
    <div class="row d-flex align-content-center justify-content-end">
        <div class="col-sm-1">
            <button class="btn btn-danger btn_exit" type="button" onclick="ir_empresa_view()"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
    <form id="insert_empresa">
        <div class="row item item_ins">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="nombre">Nombre</label>
                <input class="form-control" type="text" name="nombre">
            </div>
        </div>
        <div class="row item item_ins">
            <div class="col-sm-8 offset-2 mt-3 wrapper">
                <label for="cif">CIF</label>
                <input class="form-control" type="text" name="cif">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 offset-2 mt-3">
                <select class="form-control" name="nsedes" id="nsedes">
                    <option value="0">NºSedes</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                </select>
            </div>
            <!--Script que pinta tantos input de dirección como numero haya puesto el usuario en el select-->
            <script>
                document.getElementById("nsedes").addEventListener('change', pinta_inputs);

                function pinta_inputs() {
                    nsedes = document.getElementById("nsedes").value;
                    res = "";

                    for (i = 0; i < nsedes; i++) {
                        res += '<div class="col-sm-12 mb-2 p-0"><input class="form-control" type="text" name="direccion' + (i + 1) + '" placeholder="Dirección ' + (i + 1) + '"></div>';
                    }

                    document.getElementById("res").innerHTML = res;
                }
            </script>
            <div class="col-sm-5 offset-1 mt-3" id='res'>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 offset-5 mt-3 mb-3 d-flex justify-content-center">
                <button class="btn btn-success btn_add" type="button" onclick="add_empresa()">Añadir</button>
            </div>
        </div>
    </form>
</div>

<script>
    //Script para los label de los inputs
    $(document).ready(function() {
        $('input').each(function() {
            $(this).on('focus', function() {
                $(this).parent('.wrapper').addClass('active');
            });
            $(this).on('blur', function() {
                if ($(this).val().length === 0) {
                    $(this).parent('.wrapper').removeClass('active');
                }
            });
            if ($(this).val() !== '') $(this).parent('.wrapper').addClass('active');
        });
    });
</script>