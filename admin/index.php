<?php
include_once '../app/Controller/Controller.php';
include_once '../app/Config/Connect.php';

$Controller = new Controller();

if(!isset($_REQUEST['c'])){
    $Controller->index();
}else{
    $action = $_REQUEST['c'];
    call_user_func(array($Controller,$action));
}


?>