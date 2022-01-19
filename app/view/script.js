$('document').ready(function() {

    $('.register_butt').click(function(){
        $('.login').slideToggle();
        setTimeout(hide,500);

        function hide() {
            $('.register').slideToggle();
        }
    });

    //Slide

    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}    
        x[myIndex-1].style.display = "block"; 
        setTimeout(carousel, 2000); // Change image every 2 seconds
    }

    //Mostrar contraseñas

    document.getElementById('show_pwd').addEventListener('click',mostrarContrasena_cli);
    document.getElementById('show_pwd2').addEventListener('click',mostrarContrasena2_cli);

    function mostrarContrasena_cli(){
        var tipo = document.getElementById("password");
        if(tipo.type == "password"){
            tipo.type = "text";
        }else{
            tipo.type = "password";
        }
    }

    function mostrarContrasena2_cli(){
        var tipo = document.getElementById("password2");
        if(tipo.type == "password"){
            tipo.type = "text";
        }else{
            tipo.type = "password";
        }
    }

    //Cambiar color de inputs

    document.getElementById('password').addEventListener('blur',red);
    document.getElementById('password2').addEventListener('blur',red2);
    document.getElementById('nom_reg').addEventListener('blur',red3);
    document.getElementById('apell_reg').addEventListener('blur',red4);
    document.getElementById('dni_reg').addEventListener('blur',red5);
    document.getElementById('nfam_reg').addEventListener('blur',red6);

    document.getElementById('password').addEventListener('focus',white);
    document.getElementById('password2').addEventListener('focus',white2);
    document.getElementById('nom_reg').addEventListener('focus',white3);
    document.getElementById('apell_reg').addEventListener('focus',white4);
    document.getElementById('dni_reg').addEventListener('focus',white5);
    document.getElementById('nfam_reg').addEventListener('focus',white6);

    function red(){
        document.getElementById('password').style.backgroundColor = "#FFE4E4";
        document.getElementById('password').style.border = "1px solid #FF0000";

        document.getElementById('pwd_lab').innerHTML = "No se puede dejar en blanco";
        document.getElementById('pwd_lab').style.color = "#FF0000";
    }
    function red2(){
        document.getElementById('password2').style.backgroundColor = "#FFE4E4";
        document.getElementById('password2').style.border = "1px solid #FF0000";

        document.getElementById('pwd2_lab').innerHTML = "No se puede dejar en blanco";
        document.getElementById('pwd2_lab').style.color = "#FF0000";
    }
    function red3(){
        document.getElementById('nom_reg').style.backgroundColor = "#FFE4E4";
        document.getElementById('nom_reg').style.border = "1px solid #FF0000";

        document.getElementById('nom_lab').innerHTML = "No se puede dejar en blanco";
        document.getElementById('nom_lab').style.color = "#FF0000";
    }
    function red4(){
        document.getElementById('apell_reg').style.backgroundColor = "#FFE4E4";
        document.getElementById('apell_reg').style.border = "1px solid #FF0000";

        document.getElementById('apell_lab').innerHTML = "No se puede dejar en blanco";
        document.getElementById('apell_lab').style.color = "#FF0000";
    }
    function red5(){
        document.getElementById('dni_reg').style.backgroundColor = "#FFE4E4";
        document.getElementById('dni_reg').style.border = "1px solid #FF0000";

        document.getElementById('dni_lab').innerHTML = "No se puede dejar en blanco";
        document.getElementById('dni_lab').style.color = "#FF0000";
    }
    function red6(){
        document.getElementById('nfam_reg').style.backgroundColor = "#FFE4E4";
        document.getElementById('nfam_reg').style.border = "1px solid #FF0000";

        document.getElementById('nfam_lab').innerHTML = "No se puede dejar en blanco";
        document.getElementById('nfam_lab').style.color = "#FF0000";
    }

    function white(){
        document.getElementById('password').style.backgroundColor = "#FFFFFF";
        document.getElementById('password').style.border = "1px solid #d1d1d1";

        document.getElementById('pwd_lab').innerHTML = "";
        document.getElementById('pwd_lab').style.color = "#000000";
    }
    function white2(){
        document.getElementById('password2').style.backgroundColor = "#FFFFFF";
        document.getElementById('password2').style.border = "1px solid #d1d1d1";

        document.getElementById('pwd2_lab').innerHTML = "";
        document.getElementById('pwd2_lab').style.color = "#000000";
    }
    function white3(){
        document.getElementById('nom_reg').style.backgroundColor = "#FFFFFF";
        document.getElementById('nom_reg').style.border = "1px solid #d1d1d1";

        document.getElementById('nom_lab').innerHTML = "";
        document.getElementById('nom_lab').style.color = "#000000";
    }
    function white4(){
        document.getElementById('apell_reg').style.backgroundColor = "#FFFFFF";
        document.getElementById('apell_reg').style.border = "1px solid #d1d1d1";

        document.getElementById('apell_lab').innerHTML = "";
        document.getElementById('apell_lab').style.color = "#000000";
    }
    function white5(){
        document.getElementById('dni_reg').style.backgroundColor = "#FFFFFF";
        document.getElementById('dni_reg').style.border = "1px solid #d1d1d1";

        document.getElementById('dni_lab').innerHTML = "";
        document.getElementById('dni_lab').style.color = "#000000";
    }
    function white6(){
        document.getElementById('nfam_reg').style.backgroundColor = "#FFFFFF";
        document.getElementById('nfam_reg').style.border = "1px solid #d1d1d1";

        document.getElementById('nfam_lab').innerHTML = "";
        document.getElementById('nfam_lab').style.color = "#000000";
    }

    document.getElementById('password').addEventListener('blur',chg_color);
    document.getElementById('password2').addEventListener('blur',chg_color2);
    document.getElementById('nom_reg').addEventListener('blur',chg_color3);
    document.getElementById('apell_reg').addEventListener('blur',chg_color4);
    document.getElementById('dni_reg').addEventListener('blur',chg_color5);
    document.getElementById('nfam_reg').addEventListener('blur',chg_color6);

    function chg_color() {
        pwd = document.getElementById('password').value;

        if(pwd.length > 0){
            white();
        }
    }

    function chg_color2() {
        pwd = document.getElementById('password2').value;

        if(pwd.length > 0){
            white2();
        }
    }

    function chg_color3() {
        pwd = document.getElementById('nom_reg').value;

        if(pwd.length > 0){
            white3();
        }
    }

    function chg_color4() {
        pwd = document.getElementById('apell_reg').value;

        if(pwd.length > 0){
            white4();
        }
    }

    function chg_color5() {
        pwd = document.getElementById('dni_reg').value;

        if(pwd.length > 0){
            white5();
        }
    }

    function chg_color6() {
        pwd = document.getElementById('nfam_reg').value;

        if(pwd.length > 0){
            white6();
        }
    }

    //Habilitar buttons

    document.getElementById('log_mail').addEventListener('keyup',enable);
    document.getElementById('log_pwd').addEventListener('keyup',enable);

    function enable(){
        correo_login = document.getElementById('log_mail').value;
        passwd_login = document.getElementById('log_pwd').value;

        if((correo_login.length > 0) && (passwd_login.length > 0)){
            $('.butt_login').prop('disabled', false);
        }else{
            $('.butt_login').prop('disabled', true);
        }
    }

    document.getElementById('nom_reg').addEventListener('keyup',enable);
    document.getElementById('apell_reg').addEventListener('keyup',enable);
    document.getElementById('dni_reg').addEventListener('keyup',enable);
    document.getElementById('nfam_reg').addEventListener('keyup',enable);
    document.getElementById('password').addEventListener('keyup',enable);
    document.getElementById('password2').addEventListener('keyup',enable);
    document.getElementById('chk_reg').addEventListener('change',enable);

    function enable() {
        nombre = document.getElementById('nom_reg').value;
        apell = document.getElementById('apell_reg').value;
        dni = document.getElementById('dni_reg').value;
        nfam = document.getElementById('nfam_reg').value;
        pwd = document.getElementById('password').value;
        pwd2 = document.getElementById('password2').value;
        chk = document.getElementById('chk_reg');

        if((nombre.length > 0) && (apell.length > 0) && (dni.length > 0) && (nfam.length > 0) && (pwd.length > 0) && (pwd2.length > 0) && (chk.checked)){
            $('.butt_reg_prov').prop('disabled', false);
        }else{
            $('.butt_reg_prov').prop('disabled', true);
        }
    }
});