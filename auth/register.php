<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body class="bg-slate-800">

<?php
  include "../db.php";
  print_r($_FILES); // verificar lo que trae post  por medio del arreglo.

  if(!empty($_POST))
    {
      $alert=' ';
      if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['password']) || empty($_POST['rol'])) 
      {
        $alert='<p class="text-red-600 bg-red-200 p-2 uppercase rounded-lg">Todos los campos son obligatorios.</p>';
      }else{

        $nombre   = $_POST['nombre'];
        $correo   = $_POST['correo'];
        $password = $_POST['password'];
        $rol      = $_POST['rol'];

        $query = mysqli_query($conection, "SELECT * FROM user WHERE correo = '$email'");
        $result = mysqli_fetch_array($query);

        if($result > 0){
          $alert='<p class="text-red-600 bg-red-200 p-2 uppercase rounded-lg">El correo o el usuario ya existe.</p>';
        }else{

          $query_insert = mysqli_query($conection, "INSERT INTO user(
                                nombre,correo,password,rol)
                                    VALUES('$nombre','$email','$password','$rol')"
                              );

          if($query_insert){
            $alert='<p class="msg_save">Usuario creado Correctamente.</p>';
          }else{
            $alert='<p class="msg_error">Error al crear el usuario.</p>';
          }
        }
  
      }
    }
?>

<section class="max-w-4xl mx-auto py-20 px-5 p-10">
        <!-- Titulo -->
        <h2 class="text-4xl text-gray-400 text-center uppercase block font-bold">Registrarse</h2>
        <!-- Formulario -->
        <form class='my-10 bg-gray-400 shadow-xl rounded-lg px-10 py-5'>
          <!-- Nombre -->
          <div>
            <label 
              class='uppercase text-gray-600 block text-xl font-bold'
              htmlFor='nombre'
            >Nombre</label>
            <input
              id='nombre'
              type='nombre'
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
          <!-- Boton enviar -->
          <button 
            type="submit" 
            class='bg-sky-700 w-full mt-10 py-3 text-white uppercase font-bold rounded hover:cursor-pointer hover:bg-sky-900 transition-colors mb-5'
          >Crear Usuario</button>

        </form>
        <div class="text-center flex justify-center">
            <p class="text-lg text-gray-600 uppercase block font-normal mr-3">Si ya tienes una Cuenta</p>
            <a href="../" class="text-xl text-gray-300 uppercase block font-bold underline">Login</a>
        </div>
    </section>
</body>
</html>