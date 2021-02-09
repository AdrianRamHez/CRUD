<?php
#conexion PDO
$link = 'mysql:host=localhost;dbname=bdcolores';
$usuario = 'root';
$pass = '123456';

try {
    $pdo = new PDO($link, $usuario, $pass);
    echo 'Conectado!';
} catch (PDOException $e) {
    print "!Error¡ :" . $e->getMessage() . "<br/>";
    die();
}
?>