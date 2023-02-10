
<?php
require_once(__DIR__ . "/../conf/conf.php");
require_once(__DIR__ . "/../models/skillModel.php");
require_once(__DIR__ . "/../models/projectModel.php");


class SkillController{

    //Méthode pour récupérer les skills
    public function readAll():array{
        global $pdo;

        $sql = "SELECT * FROM skill WHERE id_skill";
        $statement = $pdo->prepare($sql);
        //$statement->bindParam(":id", $skill->id_skill, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_CLASS, "SkillModel");
        //$this->loadProjectsFromSkill($result);
        return $result;


    }


    // public function loadProjectsFromSkill(SkillModel $skill){
    
    //     global $pdo;
    //     $sql= "SELECT project.id_project, project.name, project.description, project.date_start, project.date_end, link_site, link_git, cover
    //     FROM project
    //     INNER JOIN skill_project ON skill_project.id_project = project.id_project
    //     INNER JOIN skill ON skill_project.id_skill = skill.id_skikll
    //     WHERE skill.id_skill = :id";

    //     $statement= $pdo->prepare($sql);
    //     $statement->bindParam(":id", $skill->id_skill, PDO::PARAM_INT);
    //     $statement->execute();
    //     $skill->projects = $statement->fetchAll(PDO::FETCH_CLASS, "ProjectModel");

    // }
    
    public function create(string $name, int $level, string $picture){

        if(isset($_FILES["picture"]["name"]) && $_FILES["picture"]["name"] !== null){
                    // utilisation de la fonction pathinfo() qui retourne des informations sur le chemin path, sous la forme d'une chaine ou de tableau associatif
                            // PATHINFI_EXTENTION: retourne l'extention du fichier
                      $extension = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
                      // uniqid() c'est une fonction qui génère un identifiant unique sur la base du microtime (l'heure actuelle en microseconde)
                      $picture = "skill" . uniqid() . '.' . $extension;
                      // on déplace le fichier renommé vers le dossier assets/images/upload
                      move_uploaded_file($_FILES["picture"]["tmp_name"], '../assets/images/upload/' . $picture);
                 
         }

         if(strlen($name)> 255){
             return[
                "success" => false,
                "message" => "Le nom doit contenir 255 caractère maximum"
             ];

          
         }
        //  if(!in_array($picture["type"], ["image/png", "image/jpeg", "image/webp"])) {
        //     return [
        //         "success" => false,
        //         "message" => "Formats d'image acceptés : PNG, JPEG, WebP"
        //     ];
        // }

        global $pdo;

        $sql = "INSERT INTO skill (name, level, picture)
        VALUES(:name, :level, :picture)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":level", $level);
        $statement->bindParam(":picture", $picture);
        $statement->execute();

        return[
            "success" => true,
            "message" => "une compétence a été créé"
        ];
    }

    
    

}




?> 