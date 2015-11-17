<?php
/**
 * Created by PhpStorm.
 * User: jokerwolf
 * Date: 28/10/15
 * Time: 00:29
 */

require($_SERVER['DOCUMENT_ROOT']. "/server/db/db_adapter.php");
require($_SERVER['DOCUMENT_ROOT']. "/server/db/db_controller.php");

abstract class BaseModel {
    protected $viewModel;
    protected $dbAdapter;

    //TODO Remove hardcode
    protected $userId = 1;

    //create the base and utility objects available to all models on model creation
    public function __construct()
    {
        $this -> viewModel = new ViewModel();
        $this -> commonViewData();
        $this -> dbAdapter = new DB_Adapter(DB_Controller::call(), $this -> userId);
    }
    //establish viewModel data that is required for all views in this method (i.e. the main template)
    protected function commonViewData() {

    }
}