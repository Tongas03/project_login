<div id="cardOverlay" class="overlay">
    <div class="cardProfile">

        <a class="close" href="#">&times;</a>

        <form id="formUpdater">

            <div class="cardSide">
                <div class="cardImg">
                    <picture>
                        <img src="../../assets/img/default_profile.png" alt="default_profile">
                    </picture>
                </div>
                <div class="cardDates">
                </div>
            </div>

            <div class="cardContent">
                <div class="classHeader">
                    <h2>EDITE LOS DATOS</h2>
                </div>

                <div class="cardForm">

                    <input type="hidden" id="id" name="id">
                    <input type="text" id="name" name="name" placeholder="Nombre" required>
                    <input type="text" id="surname" name="surname" placeholder="Apellido" required>
                    <input type="email" id="email" name="email" placeholder="Email" required>

                </div>
                <div class="cardFoorter">
                    <input type="submit" value="GUARDAR">
                </div>
            </div>
        </form>
    </div>
</div>