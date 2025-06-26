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

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vista administrador</title>
</head>
<body>
    <h1>Bienvenido señ@r<?php echo$fila['nombres']; ?><?php echo$fila['tip_usuer'];?></h1>
</body>
</html>