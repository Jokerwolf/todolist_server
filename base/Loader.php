<?php
/**
 * Created by PhpStorm.
 * User: jokerwolf
 * Date: 27/10/15
 * Time: 23:54
 */
session_start();

class Loader {
    private $controller;
    private $action;
    private $url_values;

    public function __construct($url_values){
        $this -> url_values = $url_values;

        if (!isset($_SESSION['user_id'])){
            $this -> controller = "accountController";
        } else if ($this -> url_values['controller'] == "") {
                $this -> controller = "homeController";
        } else {
                $this -> controller = $this -> url_values['controller'] ."Controller";
        }

        if ($this -> url_values['action'] == "") {
            $this -> action = "index";
        } else {
            $this -> action = $this -> url_values['action'];
        }
    }

    public function createController(){
        require(dirname(__FILE__). "/../controllers/" .$this -> controller. ".php");

        if (!class_exists($this -> controller)){
            require(dirname(__FILE__) . "/../controllers/errorController.php");
            return new ErrorController(BAD_URL, $this -> controller);
        }

        if (!in_array("BaseController", class_parents($this -> controller))){
            require(dirname(__FILE__) . "/../controllers/errorController.php");
            return new ErrorController(BAD_URL, $this -> controller);
        }

        if (!method_exists($this -> controller, $this -> action)){
            require(dirname(__FILE__) . "/../controllers/errorController.php");
            return new ErrorController(BAD_URL, $this -> action);
        }

        return new $this -> controller($this -> action, $this -> url_values);
    }
}