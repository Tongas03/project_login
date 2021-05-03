<?php
// ============================
//  Requires and Includes
// ============================

// require_once('../database/connection.php');
require_once '../controllers/autoloadController.php';
require_once '../controllers/errorController.php';
require_once '../config/parameters.php';

// ============================
//  Controller's Logic
// ============================

$autoload = new Autoloader();

//Controlar los parametros para mandar a raiz
if (isset($_GET['controller'])){

    $nameController = $_GET['controller'] . 'Controller';
    
    if($autoload->register($nameController)){

        if (!class_exists($nameController)) {

            showError();

        } else {

            $controller = new $nameController();

            if (isset($_GET['action']) && method_exists($controller, $_GET['action'])){

                $action = $_GET['action'];
                $controller->$action();

            } else if (!isset($_GET['action'])) {
                
                $action = defaultAction;
                $controller->$action();
                
            }
            else  {
                
                showError();
                
            }
        }

    } else {

        showError();
        
    }
} else if (!isset($_GET['controller']) && !isset($_GET['action'])) {

    $nameController = defaultController;
    $defaultAction = defaultAction;

    
    $autoload->register($nameController);

    $controller = new $nameController();
    $controller->$defaultAction();

} 

// ============================
//  Function
// ============================

// Llamar al controlador de Error
function showError(){
    $error = new errorController();
    $error->index();
}