<?php
require_once("../controllers/skillController.php");


define("PAGE_TITLE", "Ajouter une compétence"); // To define a constance, use define(): first param = name of de const, second param= title name
$controller = new SkillController;



           

if(isset($_POST['submit']) && !empty($_POST['name'])){
    $error = $controller->create($_POST['name'], $_POST['level'], $_FILES['picture']['name']);
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
            <div class="col-6 col-sm-12 ">
                <h3 class="text-center mt-3">Ajouter une compétence</h3>
                <?php if(isset($error)){ ?>
                    <div class="alert alert-danger">
                        <?= $error['message']?>
                    </div>
                <?php } ?>
                
                <form class="form-group mt-3" action="" method="post" enctype="multipart/form-data">
             
                    <input type="text" class="form-control mt-2" name="name" placeholder="Name"> 

                    <input type="text" class="form-control mt-2" name="level" placeholder="Niveau">

                    <label for="picture">Image</label>
                    <input type="file" class="form-control mt-2" id="picture" name="picture" >

                    <button type="submit" class="btn btn-success mt-1 bg-dark text-light fw-bold" name="submit">Ajouter</button>
                </form>
            </div>
        </div>

        
    </div>
</main>
<?php include('../assets/inc/footerBack.php');?>








