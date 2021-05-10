<?php
require './resources/layouts/header.php';
?>

<main>
    <div class="titleTable">

        <h1>TODOS LOS USUARIOS</h1>
        <p>Estos son todos los usuarios registrados en el sistema</p>
    </div>

    <div class="divTable">
    </div>
</main>

<script src="<?php echo BASE_PATH ?>assets/js/tableUser.js"></script>

<?php
    require './resources/layouts/popup.php';
    require './resources/layouts/cardProfile.php';
    require './resources/layouts/footer.php';
?>