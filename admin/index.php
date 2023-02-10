<?php
require_once("../controllers/accountController.php");

SESSION_START();
define("PAGE_TITLE", "Accueil Back-office"); // To define a constance, use define(): first param = name of de const, second param= title name
$accountController = new AccountController;
//permet de vérifier que l'utilisateur soit connecté
$accountController->isLogged();

?>

<?php include('../assets/inc/headBack.php');?>


<?php include('../assets/inc/headerBack.php');?>

<main class="container-fluid pt-5">
        
            <h1>Dashboard</h1>
            <h3>Vous êtes connecté</h3>
            <p>Votre email est : <?=  $_SESSION["email"]?> </p>
        <div class="d-flex justify-content-around mb-3">
            <a href="ajoutCompetence.php" class="btn btn-success">Ajouter une compétence</a>
            <a href="ajoutProjet.php" class="btn btn-success">Ajouter une un projet</a>
        </div>

</main>
<?php include('../assets/inc/footerBack.php');?>








