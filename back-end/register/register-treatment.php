<?php
// Initialize the session
require_once '../classes/User.php';
require_once '../classes-requests/user.php';
require_once '../classes/Modele.php';
require_once '../classes-requests/modele.php';
require_once '../admin/admin-utility.php';


$idModel=(int)$_POST['monselect-modele'];
//var_dump($_POST);
//var_dump($idModel);
$modeles=selectAllModeles();
//var_dump($modeles);
foreach ($modeles as $modele) {
    $modele=new Modele(
        $modele->getModeleId(),
        $modele->getModele()
    );
    var_dump($modele);
    if ($idModel=== $modele->getModeleId()){

       $model= selectModeleById($idModel);
//       var_dump($model);
}

}

// TODO pas de copiage de valeur
//exit();
// Instantiation of the user

    $user = new User(
        filter_var($_POST['lastname'], FILTER_SANITIZE_STRING),
        filter_var($_POST['firstname'], FILTER_SANITIZE_STRING),
        filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
        filter_var($_POST['phone'], FILTER_SANITIZE_STRING),
        $model,
        filter_var($_POST['password'], FILTER_SANITIZE_STRING)

    );
//Retrieval of variables linked to data entered by the user who wants to register
    $password_two = filter_var($_POST['password_two'], FILTER_SANITIZE_STRING);


//Check that all the mandatory information is filled
    if ($user->isRequiredComplete()) {
        // Verify if user exists or not
        if (!empty(selectUserByMail($user->getEmail()))) {
            header('location: ../../index.php?error=1&message=Un compte existe déjà avec cette adresse mail.');
            exit();
        }

        // Vérification  password == password_two
        if ($user->getPassword() !== $password_two) {
            header('location: ../../pages/register.php?error=1&message=Vos mots de passe ne sont pas identiques.');
            exit();
        }

        //Password verification (syntax requested)
        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/', $user->getPassword())) {
            header('Location: ../../pages/register.php?error=1&message=Un mot de passe valide aura :<br>- 8 à 15 caractères<br>- au moins une lettre minuscule<br>- au moins une lettre majuscule<br>- au moins un chiffre<br>- au moins un de ces caractères spéciaux: $ @ % * + - !');
            exit();
        }

        // HASH $secret for cookie 'auth'
        $secret = sha1($user->getEmail()) . time();
        $secret = sha1($secret) . time();
        $user->setSecret($secret);

        // HASH password
        $password = hash('sha256', $user->getPassword());
        $user->setPassword($password);
        // Insertion User in BDD
        insertUser($user);
        sendMailAdmin($user,"inscription ".$user->getLastname()." ".$user->getFirstname(), "inscription ".$user->getLastname()." ".$user->getFirstname());
        header('location:../../pages/register.php?success=1');
        exit();
    }

