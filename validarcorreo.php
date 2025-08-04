<?php
session_start();
 require_once("database/connection.php");
 $db = new database;
 $con = $db->conectar();
?>
<?php
if(isset($_POST["inicio"])){
    $usuario= $_POST['usuario'];
    $documento= $_POST['documento'];
    
    if($documento == "" ||  $usuario == ""){
      echo "<script>alert('Por favor rellene todos los campos');</script>";
      echo "<script>window.location='validarcorreo.php'</script>";
    }

    $sql = $con-> prepare("select * from user where documento = ? and user = ?");
    $sql -> execute([$documento, $usuario]);
    $fila = $sql -> fetch();
    
    if($fila){
        $_SESSION['documento'] = $fila ['documento'];
        echo "<script>window.location='cambiarcontrasena.php'</script>";
        
    }
    else{
        echo "<script>alert('usuario no encontrado intente de nuevo');</script>";
        echo "<script>window.location='validarcorreo.php'</script>";
    }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Recuperacion de contrasena</title>
    <link rel="stylesheet" href="controller/css/style.css">
</head>
<body onload="form1.usuario.focus()">
    <div class="login-box">
        <!--crea una caja imaginaria-->
        <img src="controller/image/logo.png" class="avatar" alt="Avatar Image">
        <!--insertamos una imagen-->
        <h1>Recuperacion de contraseña</h1>
        <!--Inserta titulo-->
        <form method="POST" name="form1" id="form1" autocomplete="off">
            <label for="usuario">USUARIO </label>
            <!-- etiqueta lo que se le muestra el usuario -->
            <input type="text" name="usuario" id="usuario" placeholder="Digite Usuario">
            <label for="Documento">Documento</label>
            <!-- etiqueta lo que se le muestra el usuario -->
            <input type="text" name="documento" id="documento" placeholder="Digite Usuario">
            <!-- boton-->
            <input type="submit" name="inicio" id="inicio" value="Validar">
            <!--Crear el boton-->
            <br>
            <!--Crea un salto de linea-->
            <a href="index.html">Pagina Principal</a>

        </form>
    </div>
</body>
</html>