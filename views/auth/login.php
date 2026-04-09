<?php 
  require_once __DIR__ . '/../layout/header.php'; 
?>

<main class="flex-grow flex items-center justify-center bg-gray-100 p-6">
    
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Iniciar Sesión</h2>

        <form action="<?php echo URL_PROJECT; ?>index.php?url=auth/login" method="POST" class="space-y-4">
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input type="email" name="email" id="email" required
                       class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" id="password" required
                       class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <button type="submit" 
                    class="w-full bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-500 font-semibold transition shadow">
                Entrar
            </button>

        </form>

        <p class="text-center text-sm text-gray-500 mt-4">
            ¿No tienes cuenta? 
            <a href="<?php echo URL_PROJECT; ?>index.php?url=auth/register" class="text-blue-600 hover:underline">Regístrate</a>
        </p>
    </div>
</main>

<?php 
  require_once __DIR__ . '/../layout/footer.php'; 
?>