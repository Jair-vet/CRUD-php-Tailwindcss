<?php
	
$alert = " ";
session_start();
if(!empty($_SESSION['active']))
{
	header('location: src/users.php');
}else{

		if(!empty($_POST))
		{ 
			if(empty($_POST['correo']) || empty($_POST['password']))
			{
				$alert = 'Ingrese su usuario y su clave';
			}else{

				require_once "db.php";

				$user = mysqli_real_escape_string($conection, $_POST['correo']);
				$pass = md5(mysqli_real_escape_string($conection,$_POST['password']));

				$query = mysqli_query($conection, "SELECT * FROM user WHERE correo = '$user' AND password = '$pass'");
				mysqli_close($conection);
				$result = mysqli_num_rows($query);

				if($result > 0)
				{
					$data = mysqli_fetch_array($query);
					$_SESSION['active'] = true;
					$_SESSION['id']     = $data['idusuario'];
					$_SESSION['nombre'] = $data['nombre'];
					$_SESSION['correo'] = $data['correo'];
					$_SESSION['rol']    = $data['rol'];
					$_SESSION['estatus']= $data['estatus'];

					header('location: src/users.php');
				}else{
					$alert = 'El correo o la clave son incorrectos' ;
					session_destroy();
				}
			}
		}
	}

?>

<section class="max-w-4xl mx-auto py-20 px-5 p-10">
        <!-- Titulo -->
        <h2 class="text-4xl text-gray-400 text-center uppercase block font-bold">Ingresa</h2>
        <!-- Formulario -->
        <form 
          class='my-10 bg-gray-400 shadow-xl rounded-lg px-10 py-5'
          aaction="" method="post"
        >
            <div>
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
            <div><?php echo isset($alert) 
              ? $alert
              : ''; ?>
            </div>
            <input 
              type='submit'
              value='Ingresar'
              class='bg-sky-700 w-full mt-10 py-3 text-white uppercase font-bold rounded 
                hover:cursor-pointer hover:bg-sky-900 transition-colors mb-5'
            />
        </form>
        <div class="text-center flex justify-center">
            <p class="text-lg text-gray-600 uppercase block font-normal mr-3">Si no tienes cuenta Crea una nueva</p>
            <a href="auth/register.php" class="text-xl text-gray-300 uppercase block font-bold underline">Registrarse</a>
        </div>
    </section>