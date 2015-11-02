<?php


class HomeModel extends BaseModel {
    public function get($active = 0){
        $this -> viewModel -> set("pageTitle", "todo");
        $this -> viewModel -> set("lists", $this -> dbAdapter -> getUserLists());

        return $this -> viewModel;
    }
}