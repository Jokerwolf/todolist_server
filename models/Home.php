<?php

class HomeModel extends BaseModel {
    public function get($active = 0){
        $this -> viewModel -> set("lists", $this -> dbAdapter -> getUserLists());

        return $this -> viewModel -> get("lists");
    }

    public function save($lists){
        foreach($lists as $list){
            if ($list -> id > 0){
                //Update
                $this -> dbAdapter -> updateList($list);
            } else {
                //Insert
                $list -> id = $this -> dbAdapter -> addList($list);
            }

            foreach($list -> items as $item){
                if ($item -> id > 0){
                    //Update
                    $this -> dbAdapter -> updateItem($item);
                } else {
                    //Insert
                    $item -> id = $this -> dbAdapter -> addItem($item, $list -> id);
                }
            }
        }
    }
}