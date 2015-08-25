<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/db/db_controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] .'/db/db_adapter.php');
require_once($_SERVER['DOCUMENT_ROOT'] .'/db/dto/TodoList.php');
session_start();
$_SESSION['user_id'] = 0;
echo 'Entered <br />';
$db_adapter = new DB_Adapter(DB_Controller::call(), $_SESSION['user_id']);



?>
