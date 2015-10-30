<?php
/**
 * Created by PhpStorm.
 * User: jokerwolf
 * Date: 27/10/15
 * Time: 22:25
 */

class BaseController {
    private $action;
    private $url_values;

    public function __construct($action, $url_values){
        $this -> action = $action;
        $this -> url_values = $url_values;

        echo "Action: " .$this -> action. "<br />";
    }

    public function ExecuteAction(){
        return $this -> {$this -> action}();
    }

    protected function ReturnView(){

    }
}