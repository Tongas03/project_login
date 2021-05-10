<?php
require './resources/layouts/headerLogin.php';
require './resources/layouts/popup.php';
?>

<div class="wrapper">

    <div class="formContent">

        <div class="formHeader">
            <div class="tittle">
                <h1>Registro</h1>
            </div>

            <div class="headerImg">
                <picture>
                    <img src="../../assets/img/default_profile.png" alt="default_profile">
                </picture>
            </div>
        </div>

        <?php require './resources/layouts/formUser.php' ?>

        <div class="formFooter">
            <a class="underlineHover" href="/login/index">Iniciar Sesión</a>
            <a class="underlineHover" href="#">Recuperar Contraseña</a>
        </div>

    </div>

</div>

<?php
require './resources/layouts/footerLogin.php';
?>