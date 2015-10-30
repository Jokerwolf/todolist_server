<?php
/**
 * Created by PhpStorm.
 * User: jokerwolf
 * Date: 28/10/15
 * Time: 00:49
 */
require_once($_SERVER['DOCUMENT_ROOT'] .'/server/controllers/BaseController.php');

class Error extends BaseController {
    private $type;
    private $message;

    public function __construct($type, $message){
        parent::__construct("Index", "");
        $this -> type = $type;
        $this -> message = $message;
    }

    public function Index(){
        echo "Error: " .$this -> type. "<br />Message: " .$this -> message. "<br />";
    }
}