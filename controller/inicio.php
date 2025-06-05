<?php
session_start();
 require_once("../database/connection.php");
 $db = new database;
 $con = $db->conectar();

if ($_POST["inicio"]) {
    $nombre = $_POST["usuario"]; 
    $contra = $_POST["clave"];   

    $sql = $con ->prepare("SELECT * FROM user WHERE nombres = '$nombre' AND contrasena = '$contra'") ;

    $sql -> execute();

    $fila = $sql -> fetch(); // fetchall todos o muchos fetch solo uno

    if ($fila){

        $_SESSION['doc_user'] = $fila ['documento'];
        $_SESSION['tipo'] = $fila ['id_tip_user'];
        echo "si encontro" ;
        echo $_SESSION['doc_user'];
        
        
        if ($_SESSION['tipo']== 1) {
            header("location:../model/admin/index.php");
        }
        if ($_SESSION['tipo']== 2) {
            header("location:../model/usuario/index.php");
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