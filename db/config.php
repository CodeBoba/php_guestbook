<?php
// db.ini auslesen
$array = parse_ini_file('db.ini');//true
//print_r($array)
define('INI',$array);//Konstante
//echo INI['frame'];
spl_autoload_register(
    function($class){
        include 'class/class_'.$class.'.php';
    });
?>
