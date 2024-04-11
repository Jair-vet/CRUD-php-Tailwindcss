<header>
    <div class="bg-slate-700 p-5 flex">
        <div class="w-1/2 flex md:flex-col flex-row items-center justify-center">
            <!-- Titulo -->
            <h2 class="text-4xl text-violet-400 text-center uppercase block font-bold">CRUD - php</h2>
        </div>
        <div  class="w-1/2 flex items-center justify-center gap-5">
            <div>
                <p class="text-3xl font-bold text-white">Bienvenid@: <span class="text-green-500"><?php echo $_SESSION['nombre']; ?></span></p>
                <p class="text-3xl font-bold text-white">Rol: <span class="text-green-500"><?php echo $_SESSION['rol']; ?></span></p>
            </div>
            <div>
                <a
                    href="../auth/logout.php"
                    class="shadow-xl rounded-md duration-300 uppercase bg-slate-700 hover:bg-red-600 p-3 text-white font-bold"
                >salir</a>
            </div>
        </div>
    </div>
</header>