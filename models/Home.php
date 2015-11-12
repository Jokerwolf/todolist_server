<?php

class HomeModel extends BaseModel {
    public function get($active = 0){
        $this -> viewModel -> set("lists", $this -> dbAdapter -> getUserLists());

        return $this -> viewModel -> get("lists");
    }

    public function save($lists){
        $this -> dbAdapter -> addList([]);
//        foreach($lists as $list){
//            $this -> dbAdapter -> addList($list);
//        }
    }
}