<?php
/**
 * Created by PhpStorm.
 * User: jokerwolf
 * Date: 27/10/15
 * Time: 22:25
 */

abstract class BaseController {
    protected $action;
    protected $url_values;

    protected $model;
    protected $view;

    public function __construct($action, $url_values){
        $this -> action = $action;
        $this -> url_values = $url_values;

        //establish the view object
        $this -> view = new View($_SERVER['DOCUMENT_ROOT']. '/views/' .str_replace("Controller", "", get_class($this)). '/' .strtolower($action). '.php');
    }

    public function executeAction(){
        return $this -> {$this -> action}();
    }
}