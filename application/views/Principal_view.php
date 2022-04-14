<!DOCTYPE html>
<html lang="en">

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
</head>

<body id="res_principal">
    <div class="container" id="principal">
        <button class="btn btn-info" onclick="ir_empresa_view()">Empresa</button>
        <button class="btn btn-info" onclick="ir_alumno_view()">Alumno</button>
        <button class="btn btn-info" onclick="ir_tutor_centro_view()">Tutor Centro</button>
    </div>
</body>
<script>
    //Defino como constante la url base de codeigniter
    BASE_URL = '<?php echo base_url() ?>';
</script>

</html>