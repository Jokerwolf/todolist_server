<?php
/**
 * Created by PhpStorm.
 * User: jokerwolf
 * Date: 28/10/15
 * Time: 00:41
 */

class HomeController extends BaseController {
    public function __construct($action, $url_values){
        parent::__construct($action, $url_values);

        //create the model object
        require(dirname(__FILE__) ."/../models/home.php");
        $this -> model = new HomeModel();
    }

    protected function Index(){
        $this -> view -> output($this -> model -> get());
    }
}
?>