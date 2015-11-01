<?php


class HomeModel extends BaseModel {
    public function get(){
        $this -> viewModel -> set("pageTitle", "todo");
        return $this -> viewModel;
    }
}