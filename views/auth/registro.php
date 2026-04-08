<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <div>
        <form action="<?php echo URL_PROJECT;?>index.php?url=auth/register" method="POST">
            <label>Matricula: </label>
            <input type="text" name="matricula" required>
            <label>Nombre: </label>
            <input type="text" name="nombre" required>
            <label>Apellido Paterno: </label>
            <input type="text" name="apellido_paterno" required>
            <label>Apellido Materno: </label>
            <input type="text" name="apellido_materno" required>
            <label>Correo Electrónico: </label>
            <input type="email" name="correo_electronico" required>
            <label>Contraseña: </label>
            <input type="password" name="password" required>
            <label>Confirmar Contraseña: </label>
            <input type="password" name="password_confirm" required>
            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>