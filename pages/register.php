<?php
session_start();

require_once '../inc/head.php';
require_once '../back-end/config.php';
require_once '../back-end/classes/User.php';
require_once '../back-end/classes/Modele.php';

?>
<body>
<section>
    <div id="register-body">
        <h1>S'inscrire</h1>
        <?php
            // Display register error messages if there are any
            if(isset($_GET['error'])){
                if(isset($_GET['message'])) {
                    // Display of the error message linked to the connection request
                    echo'<div class="alert error">'.nl2br($_GET['message'], false).'</div>';
                }
            // Display of the recording validation message if there is no error
            } else if(isset($_GET['success'])) {
                echo '<div class="alert success">Vous êtes désormais inscrit. <a href="../index.php">Connectez-vous</a>.</div>';
            }
            ?>
        <?php
        if
        // Display of the registration form if registration error
        (!isset($_GET['success'])) { ?>
        <form method="post" action="../back-end/register/register-treatment.php">
            <label for="lastname">
                <input type="text" id="lastname" name="lastname" maxlength="100" placeholder="Votre nom" required />
            </label>
            <label for="firstname">
                <input type="text" id="firstname" name="firstname" maxlength="100" placeholder="Votre prénom" required />
            </label>
            <label for="address">
                <input type="text" id="address" name="address" placeholder="Votre adresse" required />
            </label>
            <label for="email">
                <input type="email" id="email" name="email" maxlength="255" placeholder="Votre adresse email" required />
            </label>
            <label for="phone">
                <input type="text" id="phone" name="phone" maxlength="20" pattern="\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}" placeholder="Votre téléphone" required />
            </label>

            <label for="password">
                <input type="password" id="password" name="password" placeholder="Mot de passe" required />
            </label>
            <label for="password_two">
                <input type="password" id="password_two" name="password_two" placeholder="Retapez votre mot de passe"  required />
            </label>
            <label for="modele">
                <p>Ma BMW*</p>
                <select id="monselect-modele" name="monselect-modele" required>
                    <option value="" disabled selected>Votre BMW</option>
                    <?php
                    $pdo=getConnexion();
                    $selectAllmodele = "SELECT id, modele FROM modele";
                    $queryResult = $pdo->query($selectAllmodele);
                    $results = $queryResult->fetchAll();
                    $queryResult->closeCursor();
                    $modeles=Array();
                    foreach ($results as $result) {
                        $modele=$result['id'];
                        $nomModele=$result['modele'];
                        var_dump($nomModele);
                        echo '<option value="'.$modele.'">'.$nomModele.'</option>';
                    }
                    ?>

                </select>
            </label>
            <hr>
                <button type="submit">S'inscrire</button>
        </form>
        <p class="grey">Déjà sur ABC Conception ? <a href="../">Connectez-vous</a>.</p>
        <?php } ?>
    </div>
</section>
</body>
</html>