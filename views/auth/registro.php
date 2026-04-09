<?php 
  require_once __DIR__ . '/../layout/header.php'; 
?>

<main class="flex-grow flex items-center justify-center bg-gray-100 p-6">
    <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-2xl border border-gray-200">
        
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Crear Cuenta</h2>
            <p class="text-gray-500 text-sm mt-1">Completa los datos para el registro en Sanción Digital</p>
        </div>

        <form action="<?php echo URL_PROJECT; ?>index.php?url=auth/register" method="POST" class="space-y-5">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Matrícula</label>
                    <input type="text" name="matricula" required placeholder="Ej: 2021ITI001"
                           class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Tipo de Usuario (Rol)</label>
                    <select name="rol_id" required 
                            class="w-full mt-1 p-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 outline-none transition cursor-pointer">
                        <option value="" disabled selected>Selecciona un rol...</option>
                        
                        <option value="1">Administrador</option>
                        <option value="2">Prefecto / Instructor</option>
                        <option value="3">Alumno</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700">Nombre(s)</label>
                    <input type="text" name="nombre" required
                           class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Apellido Paterno</label>
                    <input type="text" name="apellido_paterno" required
                           class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Apellido Materno</label>
                    <input type="text" name="apellido_materno" 
                           class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700">Correo Electrónico</label>
                    <input type="email" name="correo_electronico" required placeholder="user@ejemplo.com"
                           class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
            </div>

            <hr class="border-gray-100">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Contraseña</label>
                    <input type="password" name="password" required
                           class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Confirmar Contraseña</label>
                    <input type="password" name="password_confirm" required
                           class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
            </div>
            
            <button type="submit" 
                    class="w-full bg-gray-800 hover:bg-gray-500 text-white font-bold py-3 rounded-lg shadow-lg transition transform active:scale-95">
                Finalizar Registro
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            ¿Ya tienes cuenta? 
            <a href="<?php echo URL_PROJECT; ?>index.php?url=auth/login" class="text-blue-600 font-bold hover:underline">Inicia Sesión aquí</a>
        </p>
    </div>
</main>

<?php 
  require_once __DIR__ . '/../layout/footer.php'; 
?>