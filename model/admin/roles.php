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
<?php
if (isset($_GET['regresar'])) {
    header("location:index.php");
    exit;
} 
?>
<?php
if (isset($_POST['guardar'])) {
    $tp = $_POST['tp'];
    $sql = $con->prepare("SELECT * FROM tip_user WHERE tip_usuer = ?");
    $sql->execute([$tp]);
    $fila2 = $sql -> fetch();


    if ($fila2){
        echo "<script>alert('El tipo de usuario ya existe');</script>";
    }
    else{
        $sql = $con->prepare("INSERT INTO tip_user (tip_usuer) VALUES (?)");
        $sql->execute([$tp]);
        echo "<script>alert('Tipo de usuario registrado exitosamente');</script>";
        echo "<script>window.location='roles.php'</script>";
    }
} 
?>
<?php
  $sql1 = $con->prepare("SELECT * FROM  tip_user");
  $sql1->execute();
  $restados = $sql1->fetchAll(PDO::FETCH_ASSOC);
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrar roles</title>
  <link rel="stylesheet" href="../../controller/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</head>
<body>
  <header class="encabezado">
    <h1>Bienvenido Señ@r <?php echo $fila['tip_usuer']?> <?php echo $fila['nombres']; ?></h1>
      <form method="GET">
        <button type="submit" name="cerrar_sesion" class="boton_salir">Cerrar Sesión</button>
        <button type="submit" name="regresar" class="boton_volver" > Regresar </button>
      </form>
  </header>
  <div class="contenedoradmin2">
    <div class="crear_tipos_usuarios">
        <form action="" method="post" name="save_tu" autocomplete="off">
            <h2>Registro tipos de usuario</h2>
            <input type="text" name="tp" placeholder="Ingrese el tipo de usuario" >
            <button type="submit" name="guardar">Guardar</button>
        </form>
    </div>
    <div class="tabla_tipos_usuarios">
    <table class="table table-striped-columns tabla_tipos_usuarios">
       <thead>
    <tr>  
      <th scope="col">ID Tipo de usuario</th>
      <th scope="col">Rol del usuario</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
      foreach($restados as $resul):?>
        <th scope='row'> <?php echo $resul['Id_tip_user']?></th> 
        <td> <?php echo $resul['tip_usuer']?> <a href="" onclick="window.open ('update_rol.php?id=<?php echo $resul['Id_tip_user'] ?>','',' width= 700, height= 500, toolbar=NO')"> Editar / Eliminar</a></td>
        </tr>
      <?php endforeach;?>
          
    </table>
  </div>
</body>
</html>

