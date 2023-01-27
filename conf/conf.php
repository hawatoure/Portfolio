<?php
//constate de connexion à la base de données
//nom base de donnée
define("DB_NAME", "mon_portfolio");
//nom user
define("DB_USER", "root");
//password du bdd
define("DB_PASSWORD","root");

define("DB_HOST","localhost");

$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
?>