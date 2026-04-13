<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Sanción Digital - Admin</title>
  </head>
<body class="flex flex-col min-h-screen">
  <?php if(isset($_SESSION['error'])): ?>
  <div class= 'error'><?= $_SESSION['error'] ?>?></div>
  <?php unset($_SESSION['error']);?>
  <?php endif?>
    <?php if(isset($_SESSION['success'])): ?>
    <div class= 'error'><?= $_SESSION['success'] ?>?></div>
  <?php unset($_SESSION['success']);?>
  <?php endif?>
  <div class="bg-gray-900 p-4 flex shadow border-b border-gray-700 text-white justify-between items-center">
    <h2 class="font-bold text-xl tracking-tight uppercase">Sanción Digital <span class="text-xs text-gray-500 font-normal">Panel Admin</span></h2>
    <nav>
        <div class="flex space-x-2">
            <a href="<?php echo URL_PROJECT;?>index.php?url=auth/logout" 
               class="hover:bg-gray-800 text-gray-300 px-4 py-2 rounded-none text-sm font-semibold transition">
               Cerrar Sesión
            </a>
        </div>
    </nav>
  </div>