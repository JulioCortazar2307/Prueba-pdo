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
if (isset($_GET['cerrar_sesion'])) {
    session_destroy();
    header("location:../../index.html");
    exit;
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vista admin</title>
    <link rel="stylesheet" href="../../controller/css/style.css">
</head>
<body>
    <header class="encabezado">

        <h1>Bienvenido Señ@r <?php echo $fila['tip_usuer']?> <?php echo $fila['nombres']; ?></h1>
        <form method="GET">
        <button type="submit" name="cerrar_sesion">Cerrar Sesión</button>
        </form>

    </header>
    <div class="contenedoradmin">
        <div class="imgadmin">
            <img src="../../controller/image/usuarios.png" alt="Usuarios" >
        </div>
        <div class="imgadmin">
        <img src="../../controller/image/roles.png" alt="roles" >
        </div>
        
        <br>    
        <a href="create_tu.php">Crear tipo de usuario</a>
        <br>
        <a href="create_us.php">Crear usuario</a>
    </div>
    

    
</body>
</html>