<?php
/**
 * Created by PhpStorm.
 * User: jokerwolf
 * Date: 28/10/15
 * Time: 00:49
 */

namespace com\despairsoftware\todo\server;


class Error {
    private $type;
    private $message;

    public function __construct($type, $message){
        $this -> type = $type;
        $this -> message = $message;
    }
}