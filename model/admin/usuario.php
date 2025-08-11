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
  <title>Administrar usuarios</title>
  <link rel="stylesheet" href="../../controller/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  
</head>
<body>
   <header class="encabezado">

        <h1>Bienvenido Señ@r <?php echo $fila['tip_usuer']?> <?php echo $fila['nombres']; ?></h1>
        <form method="GET">
        <button type="submit" name="cerrar_sesion" class="boton_salir">Cerrar Sesión</button>
        </form>

    </header>
    <div class="contenedoradmin">

        <?php 
          $sql1 = $con->prepare("SELECT * FROM user, tip")
        
        ?>
        <a href="" onclick="window.open
        ('update.php?id=<?php echo $resul['doc'] ?>','','whidth= 700, height =500, toolbar=NO') void(null);">
        Actualizar// Borrar
        </a>
    </div>
</body>
</html>

