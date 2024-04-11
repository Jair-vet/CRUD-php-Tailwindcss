<?php 
	
	session_start();
	include "../db.php";
	// if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2 ) // Solo Admi y Supervisores pueden ver
	// { 
	// 	header("location: ./");
	// }

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['rol']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idUsuario 	= $_POST['idUsuario'];
			$nombre 	= $_POST['nombre'];
			$email  	= $_POST['correo'];
			$clave  	= md5($_POST['password']);
			$rol    	= $_POST['rol'];

			
			$query = mysqli_query($conection,"SELECT * FROM user 
													   WHERE (correo = '$email' AND id != $idUsuario)");

			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
			}else{

				if(empty($_POST['password']))
				{

					$sql_update = mysqli_query($conection,"UPDATE user
															SET nombre = '$nombre', correo='$email',rol='$rol'
															WHERE id = $idUsuario ");
				}else{
					$sql_update = mysqli_query($conection,"UPDATE user
															SET nombre = '$nombre', correo='$email',password='$clave', rol='$rol'
															WHERE id = $idUsuario ");
				}
	
				if($sql_update){
				
					$alert= '<p class="mt-2 bg-green-200 text-green-700 p-2 rounded-md uppercase text-center">Usuario Actualizado Correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el usuario.</p>';
				}

			}


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: users.php');
		mysqli_close($conection);
	}
	$iduser = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT u.id, u.nombre, u.correo, u.rol
									FROM user u
									-- INNER JOIN rol r
									-- on u.rol = r.idrol
									WHERE id = $iduser ");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: users.php');
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$iduser  = $data['id'];
			$nombre  = $data['nombre'];
			$correo  = $data['correo'];
			$rol     = $data['rol'];

            // Extraer el tipo de Usuario
			if($rol === 'Administrador'){
				$option = '<option value="'.$rol.'" select>'.$rol.'</option>';
			}else if($rol == 'Usuario'){
				$option = '<option value="'.$rol.'" select>'.$rol.'</option>';	
			}
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
    <header>
        <div class="bg-slate-700 w-full p-5 flex justify-end">
            <div class="text-start mr-4">
                <p class="text-3xl font-bold text-white">Bienvenid@: <span class="text-green-500"><?php echo $_SESSION['nombre']; ?></span></p>
                <p class="text-3xl font-bold text-white">Rol: <span class="text-green-500"><?php echo $_SESSION['rol']; ?></span></p>
            </div>
            <div class="flex items-center">
                <a
                    href="../auth/logout.php"
                    class="shadow-xl rounded-md duration-300 uppercase bg-slate-700 hover:bg-red-600 p-3 text-white font-bold"
                >salir</a>
            </div>
        </div>
    </header>
	<section  class="max-w-4xl mx-auto py-20 px-5 p-10">
		<!-- Titulo -->
        <h2 class="text-4xl text-gray-400 text-center uppercase block font-bold">Actualizar Usuario</h2>
        
		<div class="form_register">
			<hr>
			<form class='my-10 bg-gray-400 shadow-xl rounded-lg px-10 py-5' action="" method="post">
				<input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">
                
                <!-- Nombre -->
                <div>
                <label 
                    class='uppercase text-gray-600 block text-xl font-bold'
                    htmlFor='nombre'
                >Nombre</label>
                <input
                    id='nombre'
                    type='nombre'
                    name="nombre"
                    placeholder='Escribe tu Nombre'
                    class='w-full mt-1 p-2 border rounded-lg bg-gray-200'
                    value="<?php echo $nombre; ?>"
                />
                </div>
				<!-- Correo -->
                <div class='mt-5'>
                    <label 
                        class='uppercase text-gray-600 block text-xl font-bold'
                        htmlFor='correo'
                    >Correo</label>
                    <input
                        id='correo'
                        type='correo'
                        name="correo"
                        placeholder='Escribe tu Correo'
                        class='w-full mt-1 p-2 border rounded-lg bg-gray-200'
                        value="<?php echo $correo; ?>"
                    />
                </div>
				<!-- Password -->
                <div class='mt-5'>
                    <label 
                        class='uppercase text-gray-600 block text-xl font-bold'
                        htmlFor='password'
                    >Password</label>
                    <input
                        id='password'
                        type='password'
                        name="password"
                        placeholder='Escribe un nuevo Password'
                        class='w-full mt-1 p-2 border rounded-lg bg-gray-200'
                    />
                </div>

                <!-- rol -->
                <div class='mt-5'>
                    <label class='uppercase text-gray-600 block text-xl font-bold' htmlFor='rol'>Rol</label>
                   
                    <?php 
                        include "../db.php";
                        $query_rol = mysqli_query($conection,"SELECT * FROM rol");
                        mysqli_close($conection);
                        $result_rol = mysqli_num_rows($query_rol);
				    ?>
                   
                    <select class='w-full mt-1 p-2 border rounded-lg bg-gray-200' name="rol" id="rol">
                    <?php 
                        echo $option;
                        if($result_rol > 0){
                            while ($rol = mysqli_fetch_array($query_rol)) {
                    ?>		
                        <option value="<?php echo $rol["rol"]; ?>"><?php echo $rol["rol"] ?></option>
                    <?php
                            
                            }
                        }  
                    ?>
                    </select>
                </div>
				
				<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
				
				<input 
                    type="submit" 
                    value="Actualizar usuario" 
                    class='bg-sky-700 w-full mt-10 py-3 text-white uppercase font-bold rounded hover:cursor-pointer hover:bg-sky-900 transition-colors mb-5'
                >
			</form>
            <div class="text-center flex justify-center">
                <a href="users.php" class="text-xl text-gray-400 uppercase block font-bold underline">
                    <p class="text-lg text-gray-600 uppercase block font-normal mr-3">Regregar --></p>
                </a>
            </div>
		</div>
	</section>
</body>
</html>