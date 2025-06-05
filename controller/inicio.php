<?php
 require_once("../database/connection.php");
 $db = new database;
 $con = $db->conectar();

if ($_POST["inicio"]) {
    $nombre = $_POST["usuario"]; 
    $contra = $_POST["clave"];   


    echo $nombre;
    echo $contra;
}


?>