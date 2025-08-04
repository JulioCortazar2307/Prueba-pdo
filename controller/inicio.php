<?php
session_start();
 require_once("../database/connection.php");
 $db = new database;
 $con = $db->conectar();

if ($_POST["inicio"]) {
    $nombre = $_POST["usuario"]; 
    //convertir en caracteres especiales
    $contra = htmlentities(addslashes($_POST["clave"]));

    // consultar el usuario segun usuario y claves

    $sql = $con ->prepare("SELECT * FROM user WHERE nombres = '$nombre' ") ;
    $sql -> execute();
    $fila = $sql -> fetch(); // fetchall todos o muchos fetch solo uno

    if(password_verify($contra, $fila["contrasena"])) {

        $_SESSION['doc_user'] = $fila ['documento'];
        $_SESSION['tipo'] = $fila ['id_tip_user'];
        $_SESSION['nombre'] = $fila['nombres'];
        
        
        if ($_SESSION['tipo']== 1) {
            header("location:../model/admin/index.php");
            
        }
        if ($_SESSION['tipo']== 2) {
            header("location:../model/usuarios/index.php");
        }
        if ($_SESSION['tipo']== 3) {
            header("location:../model/funcionario/index.php");  
        }
    }
    else{
        echo '<script> alert("usuario no encontrado")</scritp>' ; 
    }
}
else{


}


?>