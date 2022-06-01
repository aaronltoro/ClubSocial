<!DOCTYPE html>
<html lang="en">
<!--
@AUTORES:
    JESÚS PÉREZ RODRÍGUEZ
    AARÓN LÓPEZ TORO
    JAVIER SORIANO BAENA
-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="stylesheet" href="public/fontawesome/css/all.css">
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/main.js"></script>
    <title>CEU</title>
    <link rel="icon" type="image/ico" href="public/img/CEU.ico"/>
</head>

<body id="res_principal">
    <div class="container main_cont" id="principal">
        <div class="row">
            <div class="col-sm-1 mt-2 offset-4">
                <img src="public/img/CEU.png" alt="Logo CEU" width="300px" height="160px">
            </div>
        </div>
        <hr>
        <div class="row d-flex justify-content-around mt-5 mb-3">
            <div class="col-sm-2 d-flex justify-content-center">
                <button class="btn_inicio1" onclick="ir_empresa_view()">Empresas</button>
            </div>
            <div class="col-sm-2 d-flex justify-content-center">
                <button class="btn_inicio2" onclick="ir_alumno_view()">Alumnos</button>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-5 mb-3">
            <div class="col-sm-2 d-flex justify-content-center">
                <button class="btn_inicio5" onclick="ir_practicas_view()">Prácticas</button>
            </div>
        </div>
        <div class="row d-flex justify-content-around mt-5 mb-3">
            <div class="col-sm-2 d-flex justify-content-center">
                <button class="btn_inicio3" onclick="ir_tutor_centro_view()">Tutores Centro</button>
            </div>
            <div class="col-sm-2 d-flex justify-content-center">
                <button class="btn_inicio4" onclick="ir_empleado_view()">Empleados</button>
            </div>
        </div>
        <div class='row d-flex justify-content-end mt-5 mb-1'>
            <div class="col-sm-2 d-flex align-items-center justify-content-end">
                <p class="version">v1.1.0 @EU76119</p>
            </div>
        </div>
    </div>
</body>
<script>
    //Defino como constante la url base de codeigniter
    BASE_URL = '<?php echo base_url() ?>';
</script>

</html>