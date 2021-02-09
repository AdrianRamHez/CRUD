<?php
include_once 'conexion.php';

#LEER
$sql_leer = 'SELECT * FROM tblcolores';
$gsent = $pdo->prepare($sql_leer);
$gsent-> execute();
$resultado = $gsent->fetchAll();
#var_dump($resultado);

#AGREGAR
if($_POST){
    $id = $_POST['id'];
    $color = $_POST['color'];
    $descripcion = $_POST['descripcion'];

    $sql_agregar = 'INSERT INTO tblcolores (idcolor,vchcolor,vchdescripcion) VALUES (?,?,?)';
    $sentencia_agregar = $pdo->prepare($sql_agregar);
    $sentencia_agregar -> execute(array($id,$color,$descripcion));

    #cerrar conexion base de datos y sentencia
    $sentencia_agregar = null;
    $pdo = null;
    header('location:index.php');
}

if($_GET){
    $id = $_GET['id'];
    $sql_unico = 'SELECT * FROM tblcolores WHERE idcolor=?';
    $gsent_unico = $pdo->prepare($sql_unico);
    $gsent_unico-> execute(array($id));
    $resultado_unico = $gsent_unico->fetch();

    $gsent_unico = null;
   # var_dump($resultado_unico);
}

?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<title>COLORES</title>
</head>
<link rel="stylesheet" href="bootstrap.min.css">
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">

                <h2>COLORES</h2>
                <?php foreach($resultado as $dato): ?>
                <div class="alert alert-<?php echo $dato['vchcolor']?> text-uppercase" role="alert">
                <?php echo $dato['idcolor'] ?>
                -
                <?php echo $dato['vchcolor'] ?>
                -
                <?php echo $dato['vchdescripcion'] ?>

                <a href="eliminar.php?id=<?php echo $dato['idcolor'] ?>" class="float-right ml-3"><img width="35" height="35" src="img/delete.png"></a>

                <a href="index.php?id=<?php echo $dato['idcolor'] ?>" class="float-right"><img width="25" height="25" src="img/editar.png"></a>
                </div>
                <?php endforeach ?>
            </div>

            <div class='col-md-6'>
                <?php if(!$_GET): ?>
                    <h2>AGREGAR ELEMENTOS</h2>
                    <form method="POST">
                        <input type="text" class="form-control" name="id">
                        <input type="text" class="form-control mt-3" name="color">
                        <input type="text" class="form-control mt-3" name="descripcion">
                        <button class="btn btn-primary mt-3">Agregar</button>
                    </form>
                <?php endif ?>

                <?php if($_GET): ?>
                    <h2>EDITAR ELEMENTOS</h2>
                    <form method="GET" action="editar.php">
                        <!--<input type="text" class="form-control" name="id"-->
                        <input type="text" class="form-control mt-3" name="color"
                        value="<?php echo $resultado_unico['vchcolor']?>">
                        <input type="text" class="form-control mt-3" name="descripcion"
                        value="<?php echo $resultado_unico['vchdescripcion'] ?>">
                        <input type= "hidden" name="id" value="<?php echo $resultado_unico['idcolor'] ?>">
                        <button class="btn btn-primary mt-3">Agregar</button>
                    </form>
                <?php endif ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php

#cerrar conexion de bases de datos y sentencia
$pdo = null;
$gsent = null;

?>
