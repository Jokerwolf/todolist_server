<?php
/**
 * Created by PhpStorm.
 * User: jokerwolf
 * Date: 14/10/15
 * Time: 00:33
 */
require_once($_SERVER['DOCUMENT_ROOT'] .'/server/resources/constants.php');
require_once($_SERVER['DOCUMENT_ROOT'] .'/server/error/index.php');

if (!isset($_POST['login']) || !isset($_POST['pwd'])){
    errorPage(ERROR_MESSAGE_ENTER_LOGIN_PWD);
    exit;
}

if (accessGranted($_POST['login'], $_POST['pwd'])){
    homePage();
} else {
    errorPage(ERROR_MESSAGE_WRONG_LOGIN_PWD);
}


function homePage(){
    header('Location: todo/');
}

function accessGranted($login, $pwd){
    return true;
}
?>