<?php
  session_start();
  require_once("../../database/connection.php");
 $db = new database;
 $con = $db->conectar();

 $doc = $_SESSION['doc_user'];
 $sql = $con ->prepare("SELECT * from user inner join tip_user on user.id_tip_user = tip_user.id_tip_user where user.documento = $doc") ;
 $sql -> execute();
 $fila = $sql -> fetch(); 
?>
<?php
if (isset($_POST['cerrar_sesion'])) {
    session_destroy();
    header("location:../../index.html");
} 
?>
<?php
if (isset($_POST['guardar'])) {
    $tp = $_POST['tp'];
    if ($tp){
        $sql = $con->prepare("SELECT * FROM tip_user WHERE tip_usuer = ?");
        $sql->execute([$tp]);
        $fila = $sql -> fetch();
        echo "<script>alert('El tipo de usuario ya existe');</script>";

    }
    if($tp){
        $sql = $con->prepare("INSERT INTO tip_user (tip_usuer) VALUES (?)");
        $sql->execute([$tp]);
        echo "<script>alert('Tipo de usuario registrado exitosamente');</script>";
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear tipos de usuario</title>
</head>
<body>
    <h1>Modulo de creacion de roles</h1>
    <h1>Bienvenido señ@r <?php echo $fila['nombres']; ?> su rol es <?php echo $fila['tip_usuer'];?></h1>
    <form action=".../index.html" method="GET">
    <button type="submit" name="cerrar_sesion">Cerrar Sesión</button>
    </form>
    <table border="2">
        <form action="" method="post" name="save_tu" autocomplete="off">
            <h2>Registro tipos de usuario</h2>
            <input type="text" name="tp" placeholder="Ingrese el tipo de usuario" >
            <button type="submit" name="guardar">Guardar</button>
        </form>
    </table>
</body>
</html>