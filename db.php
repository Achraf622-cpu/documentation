<?php

$host = 'localhost';
$user = 'root';
$pass = 'password';
$database = 'bibliotheque';

// Connexion using procedural mysqli

// $db = mysqli_connect($host, $user, $pass, $database);

// if (!$db){
//     die('Conexion error'. mysqli_connect_error());
// }

// Connexion using poo mysqli

$db = new mysqli($host, $user, $pass, $database);

if (!$db){
    die('Conexion error'. $db->connect_error);
}


?>