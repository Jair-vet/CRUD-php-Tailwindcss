<?php
	// session_start();
	// if($_SESSION['rol'] != 1 ) // Solo Administrador puede ver esto
	// { 
	// 	header("location: ./");
	// }
	include "../db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - php</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>     
</head>
<body class="bg-slate-100">
    <h2 class="text-4xl text-gray-400 text-center uppercase block font-bold">Usuarios Registrados</h2>
    <table class="mx-auto bg-slate-400 w-1/2 rounded-md mt-10 shadow-lg">
        <tr class="text-center p-4">
            <th class="text-2xl font-bold text-gray-600 p-4 uppercase">ID </th>
            <th class="text-2xl font-bold text-gray-600 p-4 uppercase">Nombre</th>
            <th class="text-2xl font-bold text-gray-600 p-4 uppercase">Correo</th>
            <th class="text-2xl font-bold text-gray-600 p-4 uppercase">Rol</th>
            <th class="text-2xl font-bold text-gray-600 p-4 uppercase">Acciones</th>
        </tr>
        <?php
            $query = mysqli_query($conection, "SELECT u.id, u.nombre, u.correo, u.rol FROM user u WHERE estatus = 1"); //ASC = acendente  DSC = desendente.
                        
            mysqli_close($conection);
            $result = mysqli_num_rows($query);
            if($result > 0){
    
                while ($data = mysqli_fetch_array($query)) {
        ?>
        <tr class="text-center p-5">
            <td class="text-white border-r text-2xl p-4"><?php echo $data['id']; ?></td>
            <td class="text-white border-r text-lg p-4"><?php echo $data['nombre']; ?></td>
            <td class="text-white border-r text-lg p-4"><?php echo $data['correo']; ?></td>
            <td class="text-white border-r text-lg p-4"><?php echo $data['rol']; ?></td>
            <td class="flex flex-col mb-3">
                <a class="w-full duration-300 bg-violet-600 hover:bg-violet-700 text-white uppercase font-bold rounded-md p-2" 
                    href="src/edit_users.php?id=<?php echo $data['id']; ?>"
                > Editar</a>
                <a class="w-full duration-300 bg-green-600 hover:bg-green-700 text-white uppercase font-bold rounded-md p-2" 
                    href="src/edit_users.php?id=<?php echo $data['id']; ?>"
                > Agregar</a>
                <?php if($data["rol"] != 1){ ?>
                    <a 
                        class="w-full duration-300 bg-red-600 hover:bg-red-700 text-white uppercase font-bold rounded-md p-2"  
                        href="src/delete_users.php?id=<?php echo $data['id']; ?>"
                    > Eliminar</a>
                <?php } ?>
            </td>
        </tr> 
    <?php	
                }
        }
    
    ?>
    </table>
</body>
</html>
