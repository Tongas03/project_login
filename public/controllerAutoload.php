<?php

function autoloadController($className){

    include('../controllers/'.$className.'.php');
}

spl_autoload_register('autoloadController');