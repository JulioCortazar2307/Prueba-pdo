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

    if($fila) { 
        if(password_verify($contra, $fila["contrasena"])) {

            $_SESSION['doc_user'] = $fila ['documento'];
            $_SESSION['tipo'] = $fila ['id_tip_user'];
            $_SESSION['nombre'] = $fila['nombres'];
        
        
            if ($_SESSION['tipo']== 1) { 
                echo "<script>window.location='../model/admin/index.php';</script>";
                exit;
            
            }
            elseif ($_SESSION['tipo']== 2) {
                echo "<script>window.location='../model/usuarios/index.php';</script>";
                exit;
            }
            elseif ($_SESSION['tipo']== 3) {
                echo "<script>window.location='../model/funcionario/index.php';</script>";
                exit; 
            }
            else{
                echo'<script> alert("usuario o contraseña incorrrectos")</script>' ;  
                echo "<script>window.location='../index.html'</script>";
            }
        }

        else{
            echo '<script> alert("contraseña incorrecta")</script>' ; 
            echo "<script>window.location='../index.html'</script>";
        }
}

else {
    echo '<script>alert("usuario no encontrado")</script>';
    echo "<script>window.location='../index.html'</script>";
}
}
else{


}


?>