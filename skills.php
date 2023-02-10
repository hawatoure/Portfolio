<?php
    // 
    // require('controllers/projectController.php');
    require('controllers/skillController.php');
    define("PAGE_TITLE", "Skills"); // To define a constance, use define(): first param = name of de const, second param= title name


//instanciation de notre controller

?>



<?php include('assets/inc/headFront.php');?>


<?php include('assets/inc/headerFront.php');?>

<?php
 $controller = new SkillController;
 $result = $controller->readAll();
//  echo "<pre>"; 
//  var_dump($result);
//  echo "</pre>";
 
// ?>

<main>
<div class="container pt-5">
    <h1 class="pt-5">Compétences</h1>

    <?php
    foreach($result as $project){    ?>
   

 


    <div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="/portfolio/assets/images/skills/<?= $project->picture ?>" class="img-fluid rounded-start logo-skill py-3 px-" alt="image-logo">
  
    </div>
    <div class="col-md-8">
      <div class="card-body">
      
        <h5 class="card-title"><?= $project->name ?></h5>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis ullam dolorum possimus voluptas quod eaque? Obcaecati fugiat eius ea molestiae dolorum et consectetur dolores labore. Ab veniam delectus fugiat, cumque adipisci perferendis iure aperiam! Voluptas odio dicta amet officiis velit autem vel minus laborum voluptate saepe? Atque molestiae autem vel!</p>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-progress" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?= $project->level ?>%"></div>
        </div>
        <a href="/portfolio/skillProject.php/<?= $project->id_skill?>">Voir mes projets liés à ce langage</a>
      
      </div>
    </div>
  </div>
</div>
<?php    }  ?>

</div>


</main>

<?php include('assets/inc/footerFront.php');?>