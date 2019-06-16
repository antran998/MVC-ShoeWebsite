<?php
   
    session_start();
    require_once('Routes.php');

    function __autoload($class_name){
        if(file_exists('classes/'.$class_name.'.php')){
            require_once('classes/'.$class_name.'.php');
        }
        if(file_exists('controller/home/Controller.php')){
            require_once('controller/home/Controller.php');
        }
        if(file_exists('functionPHP/function.php')){
            require_once('functionPHP/function.php');
        }
        if(file_exists('controller/admin/adminController.php')){
            require_once('controller/admin/adminController.php');
        }
    }

    



?>