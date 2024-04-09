<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'php-CRUD';

    $conection = @mysqli_connect($host, $user, $password, $db);

    // mysqli_close($conection); Cerrar la conexion a la base de datos.

    if(!$conection){
        echo  "Error en la Base de Datos";
    }

?>