<?php
//ESTE TROZO DE CODIGO FUE REALIZADO COMPLETAMENTE POR UNA IA, PERO ENTIENDO YO COMPLETAMENTE SU FUNCIONAMIENTO 
// 1. Cargar configuraciones y la base de datos
require_once '../config/db_config.php';
require_once '../app/Core/Database.php';

// 2. Obtener la ruta limpia
// Usamos 'url' porque el .htaccess nos la manda así, o usamos la URI directamente
$url = isset($_GET['url']) ? $_GET['url'] : '';
$url = rtrim($url, '/'); // Quita la diagonal final si existe
$parts = explode('/', $url); // Rompe la URL en pedazos: [0] => Controlador, [1] => Método

// 3. Definir Controlador y Método por defecto
// Si entras a la raíz (localhost:8000), cargará el Home
$controllerName = !empty($parts[0]) ? ucfirst($parts[0]) . 'Controller' : 'HomeController';
$method = !empty($parts[1]) ? $parts[1] : 'index';

// 4. Buscar el archivo del controlador
$controllerPath = "../app/Controllers/" . $controllerName . ".php";

if (file_exists($controllerPath)) {
    require_once $controllerPath;
    
    // Conectamos a la DB (esta es la que le pasamos al constructor)
    $db = (new Database())->connect();
    
    // Instanciamos el controlador (ejemplo: new AuthController($db))
    $controller = new $controllerName($db);

    // 5. Verificar si el método existe dentro de esa clase
    if (method_exists($controller, $method)) {
        // Ejecutamos la acción (ejemplo: $controller->login())
        $controller->$method();
    } else {
        echo "Error 404: El método '$method' no existe en $controllerName.";
    }
} else {
    echo "Error 404: No encontramos el controlador $controllerName.";
}