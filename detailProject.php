<?php

    require("controllers/projectController.php");

 
    define("PAGE_TITLE", "Projet"); // To define a constance, use define(): first param = name of de const, second param= title name
?>

<?php include('assets/inc/headFront.php');?>




<?php include('assets/inc/headerFront.php');?>

<?php

//instanciation de notre controller
$controller = new ProjectController;

//appel de la méthode permettant de récupéré le méthode readAll
$oneProject = $controller->readOneProject($_GET["id"]);

?>
<main>
    <div class="container text-dark">
        <h1 class="Mon portfolio text-dark"></h1>
        <div class="row">
            <table>
                <?php //var_dump($oneProject);
  
                            ?>
                        <div class="card mx-auto m-3" style="width: 18rem;">
                            <img src="/portfolio/assets/images/project/<?= $oneProject->cover ?>" class="card-img-top" alt="project">
                            <div class="card-body">
                                <h5 class="card-title"><?= $oneProject->name ?></h5>
                                <p class="card-text"><?= $oneProject->description ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"> Démarrage du projet : <?= $oneProject->date_start ?></li>
                                <li class="list-group-item">Démarrage du projet : <?= $oneProject->date_end ?></li>
                            </ul>
                            <div class="card-body mx-auto">
                                <a href="<?= $oneProject->link_site ?>" target="_blank" class="card-link"><img src="/portfolio/assets/images/accueil/liens.png" alt="logo site web"></a>
                                <a href="<?= $oneProject->link_git ?>" class="card-link"><img src="/portfolio/assets/images/accueil/github.png" alt="logo github"></a>
                            </div>  

            </table>
        </div>

        <table>
     
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <?php  foreach($oneProject->pictures as $picture){ ?>   
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="/portfolio/assets/images/project/<?=$picture->path ?>" class="d-block w-100 img-fluid" alt="<?=$picture->alt?>">
            </div>
            <?php  } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
    </div>

</main>

<?php include('assets/inc/footerFront.php');?>