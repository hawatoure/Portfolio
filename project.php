<?php
    // 
    //require('controllers/.)
    require("controllers/projectController.php");
    //require("models/projectModel.php");


    
    define("PAGE_TITLE", "Mes projets"); // To define a constance, use define(): first param = name of de const, second param= title name
?>

<?php include('assets/inc/headFront.php');?>




<?php include('assets/inc/headerFront.php');?>

<?php

//instanciation de notre controller
$controller = new ProjectController;

//appel de la méthode permettant de récupéré le méthode readAll
$project = $controller->readAll();

?>
<main>
    <div class="container text-dark">
        <h1 class="Mon portfolio text-dark"></h1>
        <div class="row">
            <table>
                <?php //var_dump($project);

                    foreach($project as $value){
                      
                            ?>
                        <div class="card mx-auto m-3" style="width: 18rem;">
                            <img src="./assets/images/project/<?= $value->cover ?>" class="card-img-top" alt="project1">
                            <div class="card-body">
                                <h5 class="card-title"><?= $value->name ?></h5>
                                <p class="card-text"><?= $value->description ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"> Démarrage du projet : <?= $value->date_start ?></li>
                                <li class="list-group-item">Démarrage du projet : <?= $value->date_end ?></li>
                            </ul>
                            <div class="card-body">
                                <a href="<?= $value->link_site ?>" target="_blank" class="card-link">Lien du site</a>
                                <a href="" class="card-link">Lien Git Hub</a>
                            </div>
                        </div>
                    <?php
                        }
                    
                    

                ?>


            </table>
        </div>
    </div>

</main>

<?php include('assets/inc/footerFront.php');?>