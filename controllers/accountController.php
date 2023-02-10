<?php

require_once("../models/accountModel.php");
require_once("../conf/conf.php");

 //ce controller nous servira à créer de nouveau compte, à nous connecter 
 //et à vérifier la connexion quand on navigue dans la partie admin du site

class AccountController{
   public function create(string $email, string $password){
       if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
           return[
            "success" => false,
            "message" => "Email incorrect"
           ];
       }

        //verification de mot de passe
        if(strlen($password)< 8){
            return [
                "succes" => false,
                "message" => "Mot de pass trop court"
            ];
}
//verification de la force de password
        if(!preg_match("~^\S*(?=\S*[a-zA-Z])(?=\S*[0-9])(?=\S*[\W])\S*$~", $password)){
            return [
                "succes" => false,
                "message" => "Votre mot de passe doit contenir une lettre, un chiffre et un caractère spécial"
            ];
        }
    //si nous sommes arrivés jusque là, c'est que notre nouvel account est correct

        global $pdo;

        $sql = "INSERT INTO account (email, password)
        VALUES(:email, :password)";
        $statement = $pdo->prepare($sql);
        //Hachage du mdp
        $password = password_hash($password, PASSWORD_DEFAULT);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->execute();

        return[
            "success" => true,
            "message" => "un compte a été créé"
        ];
   }

   public function login(string $email, string $password){
        global $pdo;

        $sql = "SELECT id_account, email, password FROM account WHERE email = :email";
        $statement = $pdo->prepare($sql);
        $statement->bindParam("email", $email);
        $statement->execute();


        //vérifions si au moins un compte a été trouvé
        if($statement->rowCount() > 0){
            //deuxième etape : vérifier le mdp

            $statement->setFetchMode(PDO::FETCH_CLASS, "AccountModel");
            $account = $statement->fetch();

            if (password_verify($password, $account->password)) 
            {

               $_SESSION["email"] = $account->email;

               header("location: ../admin/index.php");
    
            }else {
                    return[
                        "success" => false,
                        "message" => "Mot de passe incorrect"
                    ];
            }    
        }
        else {
            return[
                "success" => false,
                "message" => "Email incorrect"
            ];
        }

   }
   public function isLogged(){
       //permet de vérifier qu'un utilisateur est connecté à l'interface admin
       if(isset($_SESSION["email"])){
        //la personne est connecté
        return true;
       }else{
           header("location:../admin/connexion.php");
       }
   }


}