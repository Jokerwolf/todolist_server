<?php


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
        if($this -> model -> login($_POST['username'], $_POST['pwd'])){
            header("Location: /home/");
        } else {
            header("Location: /account/");
        }
    }
}