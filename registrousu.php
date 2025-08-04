<?php
  session_start();
  require_once("database/connection.php");
 $db = new database;
 $con = $db->conectar();
?>
<?php 
  if(isset($_POST["registro"])){
    $doc = $_POST['doc'];
    $name= $_POST['name'];
    $clave = $_POST['clave'];
    $user = $_POST['user'];
    $rol = $_POST['rol'];


    $sql = $con-> prepare("select * from user where documento = ? or user = ?");
    $sql -> execute([$doc,$user]);
    $fila = $sql -> fetchAll();

    if($doc == "" || $name == "" || $clave == "" || $user == "" || $rol == ""){
      echo "<script>alert('Por favor rellene todos los campos');</script>";
      echo "<script>window.location='index.html'</script>";
    }
    elseif($fila){
      echo "<script>alert('usuario ya existente');</script>";
    }
    
    else{
      $hashing=password_hash($clave,PASSWORD_DEFAULT,array("pass"=> 12));


     $sql = $con->prepare("INSERT INTO user (documento, nombres, contrasena, user, id_tip_user) VALUES (?, ?, ?, ?, ?)");
     $sql -> execute([$doc, $name, $hashing, $user, $rol]);
     echo "<script>alert('Usuario registrado exitosamente');</script>"; 
    }
  }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Formulario Inicio Sesion | CAEC</title>
    <link rel="stylesheet" href="controller/css/style.css">
    
</head>

<body onload="form1.usuario.focus()">
    <div class="login-box">
        <img src="controller/image/logo.png" class="avatar" alt="Avatar Image">
        <h1>Registrarse</h1>
        <form method="POST" name="form1" id="form1" action="registrousu.php" autocomplete="off">
            <label for="doc">Documento </label>
            <input type="number" name="doc" id="doc" placeholder="Digite su Documento">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" placeholder="Ingrese su nombre">
            <label for="password">Contraseña</label>
            <input type="password" name="clave" id="clave" placeholder="Ingrese su contraseña">
            <label for="user">Usuario</label>
            <input type="Text" name="user" id="user" placeholder="Ingrese su Usuario">
            <label for="password">Tipo de usuario</label>
            <select name="rol" id="rol" >
                <option value="">Seleccione uno</option>
                <?php
                 $control = $con->prepare("SELECT * FROM tip_user");
                 $control->execute();
                 while ($fila = $control->fetch(PDO::FETCH_ASSOC)){
                  echo "<option value=".$fila['Id_tip_user'].">".$fila['tip_usuer']."</option>";
                 }
                ?>
            </select>
            <input type="submit" name="registro" id="registro" value="Registrarse">
            <a href="validarcorreo.html">Recordar Contraseña?</a>
            <br>
            <a href="registrousu.php">Registrarme?</a>
        </form>
    </div>
</body>

</html>