<?php
	session_start();
    // Validar si esta Logueado o no
    if(empty($_SESSION['active'])){
	    header('location: ../');
    }
	if($_SESSION['estatus'] != 1 ){ // Si el Usuario no existe
        session_unset();
        session_destroy();
		header("location: ../");
	}
	// if($_SESSION['rol'] != 1 ) // Solo Administrador puede ver esto
	// { 
	// 	header("location: ./");
	// }
    // print_r($_SESSION['rol']);
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
<body class="bg-slate-200">
    
    <!-- Header -->
 	<?php include("../assets/header.php")?>
      
          
    <h2 class="text-4xl mt-10 text-gray-400 text-center uppercase block font-bold">Usuarios Registrados</h2>
    
    <div class="flex justify-center text-center mt-10">
        <a class="w-1/2 duration-300 bg-green-600 hover:bg-green-700 text-white uppercase font-bold rounded-md p-2" 
            href="add_users.php"
        > Agregar</a>
    </div>
    
    <table class="mx-auto bg-slate-400 w-1/2 rounded-md mt-10 shadow-lg">
        
        <tr class="text-center p-4">
            <th class="text-2xl font-bold text-gray-600 p-4 uppercase">ID </th>
            <th class="text-2xl font-bold text-gray-600 p-4 uppercase">Nombre</th>
            <th class="text-2xl font-bold text-gray-600 p-4 uppercase">Correo</th>
            <th class="text-2xl font-bold text-gray-600 p-4 uppercase">Rol</th>
            
            <?php if($_SESSION['rol'] === 'Administrador'){ ?>
                <th class="text-2xl font-bold text-gray-600 p-4 uppercase">Acciones</th>
            <?php } ?>
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
            <?php if($_SESSION['rol'] === 'Administrador'){ ?>
                <td class="flex">
                    <a class="w-full duration-300 bg-violet-600 hover:bg-violet-700 text-white uppercase font-bold rounded-md p-2" 
                        href="edit_users.php?id=<?php echo $data['id']; ?>"
                    > Editar</a>
                    <a 
                        class="w-full duration-300 bg-red-600 hover:bg-red-700 text-white uppercase font-bold rounded-md p-2"  
                        href="delete_users.php?id=<?php echo $data['id']; ?>"
                    > Eliminar</a>
                </td>
            <?php } ?>
        </tr> 
    <?php	
                }
        }
    
    ?>
    </table>
</body>
</html>
