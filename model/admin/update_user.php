<?php
  session_start();
  require_once("../../database/connection.php");
 $db = new database;
 $con = $db->conectar();

 $sql = $con ->prepare("SELECT * FROM user INNER JOIN tip_user ON user.id_tip_user = tip_user.Id_tip_user where documento = '".$_GET['id']."'");
 $sql -> execute();
 $tipo = $sql ->fetch();

?>

<?php 
if(isset($_GET['Actualizar'])){
    $documento = $_GET['doc'] ;
    $nombre = $_GET['nuevo_nombre'] ; 
    $user = $_GET['nuevo_user'] ; 
    $tipo_user = $_GET['tipo'] ;

    $sql = $con ->prepare("UPDATE user SET nombres = ?, user = ?, id_tip_user = ? WHERE documento = ? ");
    $sql ->execute([$nombre,$user, $tipo_user, $documento]);
    echo "<script>
                alert('Datos de usuario actualizados');
                window.opener.location.reload();
                window.close(); 
              </script>";
}
?>
<?php 
if(isset($_GET['borrar'])){

    
    $sql = $con ->prepare( "DELETE FROM user WHERE documento = '".$_GET['id']."'");
    $sql -> execute();

    echo "<script>
                alert('Usuario eliminado correctamente');
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
    <title>Actualizar Usuario</title>
    
</head>
<body onload="centrar()">
    <h2>Actualizar o Eliminar usuario</h2>
    <form method="get" >

        <label for="">Documento</label>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <input type="text" name="doc" id="doc" value="<?php echo $tipo['documento'] ?>" readonly="readonly" >
        <label for="">Nombres</label>
        <input type="text" name="nuevo_nombre" id="nuevo_name" value="<?php echo $tipo['nombres'] ?>">
        <label for="">user</label>
        <input type="text" name="nuevo_user" id="nuevo_user" value="<?php echo $tipo['user'] ?>">
        <label for="">tipo de usuario</label>
        
        <select name="tipo" id="tipo">
            <option value="<?php echo $tipo['id_tip_user'] ?>"><?php echo $tipo['tip_usuer'] ?></option>
            <?php 
            $control = $con ->prepare("SELECT * FROM tip_user");
            $control ->execute();
            while ($fila = $control->fetch(PDO::FETCH_ASSOC)){
                echo "<option value=" .$fila['Id_tip_user']. ">" .$fila['tip_usuer']. "</option>"; 
            }
             ?>
        </select>

        <input type="submit" name="Actualizar" id="Actualizar" value="Actualizar">
        <input type="submit" name="borrar" id="borrar" value="Borrar">
    </form>
</body>
</html>