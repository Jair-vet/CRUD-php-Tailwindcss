<?php
	session_start();
    // Validar si esta Logueado o no
    if(empty($_SESSION['active'])){
	    header('location: ../');
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
<body class="bg-slate-200">
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

<?php
	include "../db.php";
	if(!empty($_POST))
	{
    // print_r($_POST);
		$alert=' ';
		if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['password'])) 
		{
			$alert='<p class="mt-2 bg-red-200 text-red-700 p-2 rounded-md uppercase text-center">Todos los campos son obligatorios.</p>';
		}else{

			$nombre = $_POST['nombre'];
			$email  = $_POST['correo'];
			$clave  = md5($_POST['password']);
			$rol    = $_POST['rol'];

			$query = mysqli_query($conection, "SELECT * FROM user WHERE correo = '$email'");
			$result = mysqli_fetch_array($query);

			if($result > 0){
        $alert='<p class="mt-2 bg-red-200 text-red-700 p-2 rounded-md uppercase text-center">El correo ya existe</p>';
			}else{
        // Validacion Expresión regular correo
        $matches = null;
        if(1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', "$email", $matches)){
          
          $query_insert = mysqli_query($conection, "INSERT INTO user(nombre,correo,password,rol)
                                     VALUES('$nombre','$email','$clave','$rol')"
                                  );

          if($query_insert){
            $alert= '<p class="mt-2 bg-green-200 text-green-700 p-2 rounded-md uppercase text-center">Usuario creado Correctamente.</p>';
            header('location: ../src/users.php');

          }else{
            $alert='<p class="mt-2 bg-red-200 text-red-700 p-2 rounded-md uppercase text-center">Error al crear el usuario</p>';
          }

        } else {
          $alert='<p class="mt-2 bg-red-200 text-red-700 p-2 rounded-md uppercase text-center">Error Correo invalido</p>';
        }
			}
 
		}
	}

?>

<section class="max-w-4xl mx-auto py-20 px-5 p-10">
        <!-- Titulo -->
        <h2 class="text-4xl text-gray-400 text-center uppercase block font-bold">Registra un nuevo Usuario</h2>
        <hr>
        <!-- Formulario -->
        <form 
          class='my-10 bg-gray-400 shadow-xl rounded-lg px-10 py-5'
          method="post"
          action="" 
          enctype="multipart/form-data"
        >
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
              placeholder='Escribe tu Password'
              class='w-full mt-1 p-2 border rounded-lg bg-gray-200'
            />
          </div>
          <!-- rol -->
          <div class='mt-5'>
            <label 
              class='uppercase text-gray-600 block text-xl font-bold'
              htmlFor='rol'
            >Rol</label>
            <?php 
              $query_rol = mysqli_query($conection, "SELECT * FROM rol");
              $result_rol = mysqli_num_rows($query_rol);
				    ?>
            <select class='w-full mt-1 p-2 border rounded-lg bg-gray-200' name="rol" id="rol">
              <?php 

                if($result_rol > 0)
                {
                  while ($rol = mysqli_fetch_array($query_rol)) {
              ?>		
                  <option value="<?php echo $rol["rol"]; ?>"><?php echo $rol["rol"] ?></option>
              <?php
                    
                  }
                }

              ?>
            </select>
          </div>
          <!-- Alerta  -->
          <div class="alert"><?php echo isset($alert) ? $alert : ' '; ?></div>	

          <!-- Boton enviar -->
          <input 
            type="submit" 
            value="Crear Usuario"
            class='bg-sky-700 w-full mt-10 py-3 text-white uppercase font-bold rounded hover:cursor-pointer hover:bg-sky-900 transition-colors mb-5'
          >

        </form>
        <div class="text-center flex justify-center">
            <a href="../src/users.php" class="text-xl text-gray-400 uppercase block font-bold underline">
                <p class="text-lg text-gray-600 uppercase block font-normal mr-3">Regregar --></p>
            </a>
        </div>
    </section>
</body>
</html>