<?php
session_start();
 require_once("database/connection.php");
 $db = new database;
 $con = $db->conectar();
?>
<?php
if(isset($_POST["inicio"])){ 
    $con1 = $_POST["contrasena1"];
    $con2 = $_POST['contrasena2'];
    $userconsul = $_SESSION['documento'];
    if($con1 == "" ||  $con2 == ""){
        echo "<script>alert('Por favor rellene todos los campos');</script>";
        echo "<script>window.location='cambiarcontrasena.php'</script>";
        exit();
    }
     elseif($con1 != $con2){
        echo "<script>alert('las contraseñas no son iguales');</script>";
        echo "<script>window.location='cambiarcontrasena.php'</script>";    
    }
    else{
        $hashing=password_hash($con1,PASSWORD_DEFAULT,array("pass"=> 12));
        $sql = $con ->prepare("UPDATE user Set contrasena ='$hashing' WHERE documento = '$userconsul'") ;
        $sql -> execute();
        echo "<script>alert('contraseñan actualizada correctamente');</script>";
        echo "<script>window.location='index.html'</script>"; 
     }}
?>

<html>
    <head>
    <meta charset="utf-8">
    <title>Cambio cambiarcontrasena</title>
    <link rel="stylesheet" href="controller/css/style.css">
    
</head>
<body onload="form1.usuario.focus()">
    <div class="login-box">
        <!--crea una caja imaginaria-->
        <img src="controller/image/logo.png" class="avatar" alt="Avatar Image">
        <!--insertamos una imagen-->
        <h1>Nueva contraseña</h1>
        <!--Inserta titulo-->
        <form method="POST" name="form1" id="form1" autocomplete="off">
            <label for="usuario">Nueva contraseña </label>
            <!-- etiqueta lo que se le muestra el usuario -->
            <input type="text" name="contrasena1" id="contrasena" placeholder="Digite su Nueva contraseña">
            <label for="Documento">Verifique contraseña</label>
            <!-- etiqueta lo que se le muestra el usuario -->
            <input type="text" name="contrasena2" id="contrasena2" placeholder="Verifique la contraseña">
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