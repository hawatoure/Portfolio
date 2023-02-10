<?php
session_start();
require_once("../controllers/projectController.php");
require_once("../models/skillModel.php");
require_once("../controllers/accountController.php");
require_once("../controllers/skillController.php");
define("PAGE_TITLE", "Ajouter un projet"); // To define a constance, use define(): first param = name of de const, second param= title name
$controller = new ProjectController;

// Permet de vérifier que l'utilisateur soit connecté
$accountController = new AccountController;
$accountController->isLogged();

$skillController = new SkillController;
// Récupération de toutes les compétences
$skills = $skillController->readAll();



           
  //Envoi des informationsbdu formulaire pour créer un nouveau projet
 if(isset($_POST['submit']) && !empty($_POST['name'])){
    $projectController = new ProjectController;

    if($_POST["name"]||strlen($_POST["description"])>1 && $_POST["date_start"] != NULL)

    $result = $projectController->create($_POST['name'], $_POST['description'], $_POST['date_start'], $_POST['date_end'], $_POST['link_site'], $_POST['link_git'], $_FILES['cover']['name'], $_POST["skills"]);
 }
                            echo "<pre>";
                            var_dump($_POST); 
                            echo "</pre>";

 ?>

<?php include('../assets/inc/headBack.php');?>


<?php include('../assets/inc/headerBack.php');?>

<main>
    <div class="container">
        <h3></h3>
        <div class="row justify-content-center">
            <div class="col-4 ">
                <h3 class="text-center mt-3">Ajouter un projet</h3>
                <?php if(isset($error)){ ?>
                    <div class="alert alert-success">
                        <?= $result['message']?>
                    </div>
                <?php } ?>

        
                
                <form class="form-group mt-3" action="" method="post" enctype="multipart/form-data">
             
                    <input type="text" class="form-control mt-2" name="name" placeholder="Nom du projet"> 

                    <input type="text" class="form-control mt-2" name="description" placeholder="Description">

                    <input type="date" class="form-control mt-2" name="date_start">

                    <input type="date" class="form-control mt-2" name="date_end">
                    <input type="text" class="form-control mt-2" name="link_site" placeholder="Lien du site">
                    <input type="text" class="form-control mt-2" name="link_git" placeholder="Lien github">
                    <label for="skills">Compétences</label>
                    <select name="skills[]" id="skills" class="form-control" multiple>
                        <?php foreach($skills as $skill){?>
                        <option value="<?= $skill->id_skill?>"><?= $skill->name?></option>
                        <?php } ?>
                    </select>
                    <label for="picture">Image</label>
                    <input type="file" class="form-control mt-2" id="cover" name="cover" >

                    <button type="submit" class="btn btn-success mt-1 bg-dark text-light fw-bold" name="submit">Ajouter</button>
                </form>
            </div>
        </div>

        
    </div>
</main>
<?php include('../assets/inc/footerBack.php');?>




