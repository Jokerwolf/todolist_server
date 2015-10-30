<?php
/**
 * Created by PhpStorm.
 * User: jokerwolf
 * Date: 27/10/15
 * Time: 23:54
 */

namespace com\despairsoftware\todo\server;


use com\despairsoftware\todo\server\controllers\BaseController;

class Loader {
    private $controller;
    private $action;
    private $url_values;

    public function __construct($url_values){
        $this -> url_values = $url_values;
        if ($this -> url_values['controller'] == "") {
            $this -> controller = "home";
        } else {
            $this->controller = $this -> url_values['controller'];
        }

        if ($this -> url_values['acti52on'] == "") {
            $this -> action = "index";
        } else {
            $this -> action = $this -> url_values['action'];
        }
    }

    public function CreateController(){
        if (!class_exists($this -> controller)){
            return new Error(BAD_URL, $this -> controller);
        }

        if (!function_exists($this -> action)){
            return new Error(BAD_URL, $this -> action);
        }

        return new BaseController();
    }
}