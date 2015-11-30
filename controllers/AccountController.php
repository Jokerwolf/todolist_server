<?php
session_start();

class AccountController extends BaseController {
    public function __construct($action, $url_values){
        parent::__construct($action, $url_values);

        //create the model object
        require(dirname(__FILE__) ."/../models/account.php");
        $this -> model = new AccountModel();
    }

    public function index(){
        $this -> view -> output(null, null);
    }

    public function login(){
        $user_id = $this -> model -> login($_POST['username'], $_POST['pwd']);
        if($user_id != null){
            $_SESSION['user_id'] = $user_id;
            header("Location: /home/");
        } else {
            session_unset();
            header("Location: /account/");
        }
    }

    public function logout(){
        session_unset();
        header("Location: /account/");
    }

    public function register(){

    }

    public function restore(){

    }
}