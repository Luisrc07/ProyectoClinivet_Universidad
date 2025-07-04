<?php
include_once 'Config/conexion.php';


$controllerName = $_GET['controller'] ?? 'home';  
$methodName = $_GET['method'] ?? 'listarPorLetra';      


try {
    if ($controllerName == 'home') {
        include_once 'Views/home.php';
    } else {
        include_once "controllers/{$controllerName}.php";
        
        $controller = new $controllerName();
        
        if ($methodName == 'listarPorLetra' && isset($_POST['letra'])) {
            $letra = $_POST['letra'];
            $controller->{$methodName}($letra);
            exit;
        }

        if (method_exists($controller, $methodName)) {
          
            $controller->{$methodName}();
        } else {
            throw new Exception("Método {$methodName} no encontrado en {$controllerName}");
        }
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
