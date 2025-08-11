<?php
  session_start();
  require_once("../../database/connection.php");
 $db = new database;
 $con = $db->conectar();

 $sql = $con ->prepare("SELECT * FROM tip_user where Id_tip_user = '".$_GET['id']."'");
 $sql -> execute();
 $tipo = $sql ->fetch();

?>
<?php 
if(isset($_GET ['Actualizar'])){
    $id_tip= $tipo['Id_tip_user'];
    $nombre_rol = $_GET['nuevo_name'];

    $actualizar = $con ->prepare("UPDATE tip_user SET tip_usuer = ? WHERE Id_tip_user = ?");
    $actualizar -> execute([$nombre_rol,  $id_tip]);
        echo "<script>
                alert('Rol actualizado correctamente.');
                window.opener.location.reload();
                window.close(); 

              </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
    <script>
        function centrar(){
            iz=(screen.width.body.clientwidth) /2;
            de=(screen.height.body.clientheight) /2;
        }
    </script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar o eliminar tipo de usuario</title>
</head>
<body onload="centrar()">
    <h2>Actualizar o Eliminar usuario</h2>
    <form method="get"     >
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <label for="">Nombre del rol</label>
        <input type="text" name="nuevo_name" id="nuevo_name" value="<?php echo $tipo['tip_usuer'] ?>">
        <input type="submit" name="Actualizar" id="" value="Actualizar">
        <input type="submit" name="borrar" id="borrar" value="Borrar">
    </form>
</body>
</html>