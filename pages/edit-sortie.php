<?php
session_start();
require_once '../back-end/classes/User.php';
require_once '../back-end/classes/Modele.php';
require_once '../back-end/config.php';
include_once '../inc/head.php';


//if (intval(unserialize($_SESSION['user'])->getAdmin()) === 0
//    && intval(unserialize($_SESSION['user'])->getId()) !== intval($_GET['id'])) {
//    header('location: ../back-end/profil/profil-treatment.php?id='.unserialize($_SESSION['user'])->getId());
//    exit();
//}
?>

<body>
<?php
include_once '../inc/header.php';
?>
<section id="landing">
    <div class="container">
        <h1>
            <b>Création de Sortie</b>
        </h1>
    </div>
</section>

<section id="formulaire">
    <div class="container">
        <form action="../back-end/admin/sortie-treatment.php" method="POST">
            <?php
            if (isset($_GET['error'])) {
                echo '<div class="alert error">'.utf8_decode($_GET['message']).'</div><br>';
            }
            ?>
<!--            <input type="hidden" name="idProfil" value="--><?//=$_GET['id']?><!--">-->
            <label for="sortieName">
                <p>Nom de la sortie*</p>
                <input type="text" id="sortieName" name="sortieName" placeholder="Nom de la sortie" maxlength="100" required>
            </label>
            <label for="description">
                <p>Description*</p>
                <textarea style="height: 100px" id="description" name="description" placeholder="Description"  maxlength="4000"  required></textarea>
            </label>
            <label for="nbrMax">
                <p>Nombre de places*</p>
                <input type="number" id="nbrMax" name="nbrMax" placeholder="Nombre de places"  maxlength="255" required>
            </label>
            <label for="distance">
                <p>Distance Km*</p>
                <input type="number" id="distance" name="distance" placeholder="Distance en Km"  maxlength="255" required >
            </label>
            <label for="date">
                <p>Date*</p>
                <input type="date" id="date" name="date"  required >
            </label>


<!--            TODO: A continuer !!!!!!-->


<!--            --><?php
//            if (intval(unserialize($_SESSION['user'])->getId()) !== intval($user->getId())
//                && intval(unserialize($_SESSION['user'])->getAdmin()) !== 0) {
//                    TODO si ADMIN
//            }
//            ?>
            <div class="div-btn">
            <button id="submit" class="btn" type="submit">Enregistrer</button>
            <button class="btn" type="button">Annuler</button>
            </div>
        </form>
    </div>
</section>
<script src="../js/app.js"></script>
</body>
</html>