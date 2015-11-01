<?php
/**
 * Created by PhpStorm.
 * User: jokerwolf
 * Date: 28/10/15
 * Time: 00:29
 */

abstract class BaseModel {
    protected $viewModel;

    //create the base and utility objects available to all models on model creation
    public function __construct()
    {
        $this -> viewModel = new ViewModel();
        $this -> commonViewData();
    }
    //establish viewModel data that is required for all views in this method (i.e. the main template)
    protected function commonViewData() {

    }
}