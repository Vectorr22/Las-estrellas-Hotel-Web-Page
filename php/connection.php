<?php   

$server ="localhost";
$user = "root";
$pass = "";
$db = "users";

$conexion = new mysqli($server, $user, $pass, $db);

if($conexion -> connect_error){
    die("Error en la conexion". $conexion -> connect_error);
}



