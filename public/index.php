<?php
// public/index.php
define('BASE_PATH', dirname(__DIR__));

// Cargar autoload para modelos
require_once BASE_PATH . '..\helpers\autoload.php';
require_once BASE_PATH . '..\controllers\ProductoController.php';
require_once BASE_PATH . '..\config\database.php';

// Obtener controlador y acción desde la URL o usar valores por defecto
$controller = $_GET['controller'] ?? 'producto';
$action = $_GET['action'] ?? 'index';

// Construir ruta del archivo controlador
$controllerFile = "../controllers/" . ucfirst($controller) . "Controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($controller) . "Controller";

    if (class_exists($controllerClass)) {
        $controlador = new $controllerClass();
        if (method_exists($controlador, $action)) {
            $controlador->$action();
        } else {
            echo "Acción '$action' no encontrada.";
        }
    } else {
        echo "Controlador '$controllerClass' no encontrado.";
    }
} else {
    echo "Archivo de controlador '$controllerFile' no existe.";
}
