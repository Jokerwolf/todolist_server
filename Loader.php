<?php
/**
 * Created by PhpStorm.
 * User: jokerwolf
 * Date: 27/10/15
 * Time: 23:54
 */
require_once($_SERVER['DOCUMENT_ROOT'] .'/server/controllers/Error.php');

class Loader {
    private $controller;
    private $action;
    private $url_values;

    public function __construct($url_values){
        $this -> url_values = $url_values;

        if ($this -> url_values['controller'] == "") {
            $this -> controller = "Home";
        } else {
            $this->controller = $this -> url_values['controller'];
        }

        if ($this -> url_values['action'] == "") {
            $this -> action = "Index";
        } else {
            $this -> action = $this -> url_values['action'];
        }

        var_dump($this -> url_values);
    }

    public function CreateController(){
        if (!class_exists($this -> controller)){
            return new Error(BAD_URL, $this -> controller);
        }

        if (!method_exists($this -> controller, $this -> action)){
            return new Error(BAD_URL, $this -> action);
        }

        return new $this -> controller($this -> action, $this -> url_values);
    }
}