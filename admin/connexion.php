<?php
require_once("../controllers/accountController.php");


SESSION_START();
define("PAGE_TITLE", "Connexion Back-office"); // To define a constance, use define(): first param = name of de const, second param= title name

$controller = new AccountController;

// $result = $controller->create($_POST['email']);
// var_dump($result);

    if(isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password'])){

            $error = $controller->login($_POST['email'], $_POST['password']);
            var_dump($_POST);
            var_dump($error);

               
    }

?>

<?php include('../assets/inc/headBack.php');?>


<?php include('../assets/inc/headerBack.php');?>





    <div class="container-fluid row col-6 border rounded-10 mt-10 pt-10 mx-auto">
        <h1 >Connexion à l'espace administrateur</h1>
        <?php if(isset($error)){ ?>
            <div class="alert alert-danger">
                <?= $error['message']?>
            </div>
        <?php } ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="email" class="form-label col-4">Email</label>
                <input type="email" class="form-control" id="email" placeholder="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label col-4">Mot de passe</label>
                <input type="password" class="form-control" id="password" placeholder="placeholder" rows="3" name="password">
            </div>
            <button type="submit" name="submit" class="bg-info col-3 btn mx-auto mb-3 text-center">Valider</button>
        </form>
    </div>




<?php include('../assets/inc/footerBack.php');?>














