<?php
require './resources/layouts/headerLogin.php';
require './resources/layouts/popup.php';
?>

<div class="wrapper">
    <div class="formContent">

        <div class="formHeader">
            <div class="tittle">
                <h1>Acceso</h1>
            </div>

            <div class="headerImg">
                <picture>
                    <img src="../../assets/img/default_profile.png" alt="default_profile">
                </picture>
            </div>
        </div>

        <form id="formLogin">
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Contraseña" required>
            <input type="submit" value="INGRESAR">
        </form>

        <div class="formFooter">
            <a class="underlineHover" href="/register/index">Registrarse</a>
            <a class="underlineHover" href="#">Recuperar Contraseña</a>
        </div>

    </div>
</div>

<?php
require './resources/layouts/footerLogin.php';
?>