<?php

    require("controllers/skillController.php");

 
    define("PAGE_TITLE", "Projet_compétence"); // To define a constance, use define(): first param = name of de const, second param= title name
?>

<?php include('assets/inc/headFront.php');?>




<?php include('assets/inc/headerFront.php');?>

<?php


$controller = new SkillController;

$skillProject = $controller->readAll($_GET["id"]);

?>
<main>
    <div class="container text-dark pt-5">
        <h1 class="Mon portfolio text-dark"></h1>
        <div class="row">
            <table>
                <?php 
                
                echo "<pre>"; 
                var_dump($skillProject);
                echo "</pre>";
                            ?>
                    <?php  foreach($skillProject as $project){ ?>   
                        <div class="card mx-auto m-3" style="width: 18rem;">
                            <img src="/portfolio/assets/images/project/<?= $project->cover ?>" class="card-img-top" alt="project">
                            <div class="card-body">
                                <h5 class="card-title"><?= $project->name ?></h5>
                                <p class="card-text"><?= $project->description ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"> Démarrage du projet : <?= $project->date_start ?></li>
                                <li class="list-group-item">Démarrage du projet : <?= $project->date_end ?></li>
                            </ul>
                            <div class="card-body mx-auto">
                                <a href="<?= $project->link_site ?>" target="_blank" class="card-link"><img src="/portfolio/assets/images/accueil/liens.png" alt="logo site web"></a>
                                <a href="<?= $project->link_git ?>" class="card-link"><img src="/portfolio/assets/images/accueil/github.png" alt="logo github"></a>
                            </div>  
                            </div>
            <?php  } ?>

            </table>
        </div>

        <table>


</main>

<?php include('assets/inc/footerFront.php');?>