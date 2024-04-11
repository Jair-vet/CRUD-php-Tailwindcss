<?php
	session_start();
    if(empty($_SESSION['active'])){
	    header('location: ../');
    }
	
	include "../db.php";

	if(!empty($_POST))
	{
	
		$id = $_POST['id'];

		//$query_delet = mysqli_query($conection, "DELETE FROM user WHERE id = $id "); eliminar un registro de la base de datos
		$query_delete = mysqli_query($conection, "UPDATE user SET estatus = 0 WHERE id = $id ");
		mysqli_close($conection);
		
        if($query_delete){
            session_destroy();  // Eliminar el logueo
			header("location: users.php"); // Redirect
		}else{
			echo "Error al Eliminar";
		}
	}

	if(empty($_REQUEST['id']) ){
		
        header("location: users.php");
		mysqli_close($conection);

	} else{

		$id = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT u.nombre, u.correo, u.rol, u.created_at 
											FROM user u 
											WHERE u.id = $id");
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$nombre  = $data['nombre'];
				$correo  = $data['correo'];
				$rol     = $data['rol'];
				$created_at = $data['created_at'];
			}
		}else{
			header("location: users.php");
		}

	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD - php</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
    
	<!-- Header -->
 	<?php include("../assets/header.php")?>

	<section class="max-w-4xl mx-auto py-20 px-5 p-10">
        <!-- Titulo -->
        <h2 class="text-4xl text-gray-400 text-center uppercase block font-bold">Eliminar Usuario</h2>
        
		<div class='my-10 bg-slate-700 shadow-xl rounded-lg p-10'>
			<h2 class="text-2xl uppercase font-bold text-violet-400 text-center mb-2">¿Seguro que Quiere Eliminar este Usuario?</h2>
			<p class="text-xl uppercase font-bold text-white mt-5"> Nombre: <span class="text-green-500"><?php echo $nombre ?></span></p>
			<p class="text-xl uppercase font-bold text-white"> Correo: <span class="text-green-500"><?php echo $correo ?></span></p>
			<p class="text-xl uppercase font-bold text-white"> Fecha de Creación: <span class="text-green-500"><?php echo $created_at ?></span></p>
			<p class="text-xl uppercase font-bold text-white"> Privilegios: <span class="text-green-500"><?php echo $rol ?></span></p>
		</div>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $id; ?>" >
            <div class="w-full flex items-center justify-center">
                <a 
                    href="users.php" 
                    class="w-1/2 mr-2 ml-2 text-center bg-yellow-500 hover:bg-yellow-600 p-2 rounded-md font-bold text-white"
                > Cancelar</a>
                <button 
                    type="submit" 
                    class="w-1/2 mr-2 ml-2 text-center bg-red-500 hover:bg-red-600 p-2 rounded-md font-bold text-white"
                > Eliminar</button>
            </div>
        </form>
	</section>
</body>
</html>