<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Sancion Digital</title>
  </head>
<body class="flex flex-col min-h-screen">
  <div class="bg-gray-900 p-4 flex shadow border-b border-gray-700 text-white justify-between items-center">
    <h2 class="font-bold text-xl tracking-tight">Sanción Digital</h2>
    <nav>
        <div class="flex space-x-2">
            <a href="<?php echo URL_PROJECT; ?>index.php?url=auth/login" 
               class="hover:bg-gray-800 text-gray-300 px-4 py-2 rounded-lg text-sm font-semibold transition"> 
               Iniciar Sesión
            </a>
            <a href="<?php echo URL_PROJECT;?>index.php?url=auth/register" 
               class="hover:bg-gray-800 text-gray-300 px-4 py-2 rounded-lg text-sm font-semibold transition">
               Registrarse
            </a>
        </div>
    </nav>
</div>