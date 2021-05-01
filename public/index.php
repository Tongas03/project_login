<?php
// ============================
//  Requires and Includes
// ============================

// require_once('../database/connection.php');
require('./controllerAutoload.php');

// ============================
//  Controller's Logic
// ============================

//Verificar que exista el controlador
if(isset($_GET['controller'])){
    $nameController = $_GET['controller'].'Controller';
} else {
    echo 'La página no exite';
    exit();
}

//Verficar que exista acción en el controlador
if(class_exists($nameController)){
    $controller = new $nameController();

    if(isset($_GET['action']) && method_exists($controller, $_GET['action'])){
        $action = $_GET['action'];
        $controller->$action();
    } else {
        echo 'La página no exite';
    }
} else {
    echo 'La página no exite';
}