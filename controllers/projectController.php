<?php
require_once(__DIR__ . "/../conf/conf.php");
require_once(__DIR__ . "/../models/projectModel.php");
require_once(__DIR__ . "/../models/pictureModel.php");
require_once(__DIR__ . "/../models/skillModel.php");

class ProjectController{



   public function readAll():array{
        global $pdo;

        $sql = "SELECT * FROM project";
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_CLASS, "ProjectModel");

        foreach($result as $project){
            $this->loadSkillsFromProject($project);

        }

        return $result;
        
    }

    public function readOneProject(int $id): ProjectModel{
        global $pdo;
        $sql = "SELECT * FROM project WHERE id_project = :id";
        $statement= $pdo->prepare($sql);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, "ProjectModel");
        $oneProject = $statement->fetch();

        //requête récupération des images

        $sql = "SELECT * FROM picture WHERE id_project = :id";
        $statement= $pdo->prepare($sql);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
        $pictures = $statement->fetchAll(PDO::FETCH_CLASS, "PictureModel");
        $oneProject->pictures = $pictures;

        // Requête de récupération des skills
        $this->loadSkillsFromProject($oneProject);

        return $oneProject;


    }

    public function loadSkillsFromProject(ProjectModel $project){
    
        global $pdo;
        $sql= "SELECT skill.id_skill, skill.name, skill.level, skill.picture
        FROM skill
        INNER JOIN skill_project ON skill_project.id_skill = skill.id_skill
        INNER JOIN project ON skill_project.id_project = project.id_project
        WHERE project.id_project = :id";

        $statement= $pdo->prepare($sql);
        $statement->bindParam(":id", $project->id_project, PDO::PARAM_INT);
        $statement->execute();
        $project->skills = $statement->fetchAll(PDO::FETCH_CLASS, "SkillModel");;

    }

        
    public function create(string $name, string $description, string $date_start, string $date_end, string $link_site, string $link_git, string $cover, array $skills){

        if(strlen($name) > 255){
            return[
                "success" => false,
                "message" => "Le nom doit contenir 255 caractère maximum"
             ];
         
        }
        if(strlen($link_site) > 50){
            return[
                "success" => false,
                "message" => "Le lien doit contenir 50 caractère maximum"
             ];
         }
        if(strlen($link_git) > 50){
            return[
                "success" => false,
                "message" => "Le lien doit contenir 50 caractère maximum"
             ];
         }
         
         //fin des vérifications

        if(isset($_FILES["cover"]["name"]) && $_FILES["cover"]["name"] !== null){
                    // utilisation de la fonction pathinfo() qui retourne des informations sur le chemin path, sous la forme d'une chaine ou de tableau associatif
                            // PATHINFI_EXTENTION: retourne l'extention du fichier
                      $extension = pathinfo($_FILES["cover"]["name"], PATHINFO_EXTENSION);
                      // uniqid() c'est une fonction qui génère un identifiant unique sur la base du microtime (l'heure actuelle en microseconde)
                      $cover = "project" . uniqid() . '.' . $extension;
                      // on déplace le fichier renommé vers le dossier assets/images/upload
                      move_uploaded_file($_FILES["cover"]["tmp_name"], '../assets/images/project/' . $cover);   
         }

        global $pdo;

        $sql = "INSERT INTO project (name, description, date_start, date_end, link_site, link_git, cover)
        VALUES(:name, :description, :date_start, :date_end, :link_site, :link_git, :cover)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":description", $description);
        $statement->bindParam(":date_start", $date_start);

        $date_end = ($date_end == " " ? null : $date_end);
        $statement->bindParam(":date_end",  $date_end);

        $link_site = ($link_site == " " ? null : $link_site);
        $statement->bindParam(":link_site", $link_site);

        $link_git = ($link_git == " " ? null : $link_git);
        $statement->bindParam(":link_git", $link_git);

        $statement->bindParam(":cover", $cover);
        $statement->execute();

         $id_project = $pdo->lastInsertId();

        //Insertion des compétences du projet
        if(count($skills) > 0){
            foreach($skills as $id_skill){
                $sql = "INSERT INTO skill_project
                (id_project, id_skill)
                VALUE (:id_project, :id_skill)";
                $statement = $pdo->prepare($sql);
                $statement->bindParam(":id_project", $id_project);
                $statement->bindParam(":id_skill", $id_skill);
                $statement->execute();

            }
        }    
        return[
            "success" => true,
            "message" => "Un nouveau projet a été ajouté"
        ];
    }
    
    


}

?>