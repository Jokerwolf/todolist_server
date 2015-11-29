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

    //GET
    protected function index(){
        $this -> view -> output(null, null);
    }

    //GET
    protected function getLists(){
        echo json_encode($this -> model -> get());
    }

    //POST
    protected function saveLists(){
        $rawData = file_get_contents('php://input');
        $this -> model -> save(json_decode($rawData));
    }

    //POST
    protected function saveList(){
        $rawData = file_get_contents('php://input');
        $list = $this -> model -> saveList(json_decode($rawData));

        echo json_encode($list);
    }

    //POST
    protected function saveItem(){
        $rawData = file_get_contents('php://input');
        $item = $this -> model -> saveItem(json_decode($rawData));

        echo json_encode($item);
    }
}
?>