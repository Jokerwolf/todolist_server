<?php
/**
 * Created by PhpStorm.
 * User: jokerwolf
 * Date: 28/10/15
 * Time: 00:41
 */

class Home extends BaseController {
    public function __construct($action, $url_values){
        parent::__construct($action, $url_values);
    }

    function Index(){
        echo "Index called";
    }
}