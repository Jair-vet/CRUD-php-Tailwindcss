<section class="max-w-4xl mx-auto py-20 px-5 p-10">
        <!-- Titulo -->
        <h2 class="text-4xl text-gray-400 text-center uppercase block font-bold">Bienvenido</h2>
        <!-- Formulario -->
        <form class='my-10 bg-gray-400 shadow-xl rounded-lg px-10 py-5'>
            <div>
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
    
            <input 
              type='submit'
              value='Log In'
              class='bg-sky-700 w-full mt-10 py-3 text-white uppercase font-bold rounded 
                hover:cursor-pointer hover:bg-sky-900 transition-colors mb-5'
            />
        </form>
        <div class="text-center flex justify-center">
            <p class="text-lg text-gray-600 uppercase block font-normal mr-3">Si no tienes cuenta Crea una nueva</p>
            <a href="auth/register.php" class="text-xl text-gray-300 uppercase block font-bold underline">Registrarse</a>
        </div>
    </section>