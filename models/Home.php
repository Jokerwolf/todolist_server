<?php

class HomeModel extends BaseModel {
    public function get($active = 0){
        $this -> viewModel -> set("lists", $this -> dbAdapter -> getUserLists());

        return $this -> viewModel -> get("lists");
    }

    public function save($lists){
        foreach($lists as $list){
            saveList($list);
        }
    }

    public function saveList($list){
        if ($list -> id > 0){
            //Update or delete
            if ($list -> isDeleted == 1){
                $this -> dbAdapter -> deleteList($list);
                $list = null;
            } else {
                $this -> dbAdapter -> updateList($list);
            }
        } else {
            //Insert
            $list -> id = $this -> dbAdapter -> addList($list);
        }

        if ($list != null) {
            foreach ($list->items as $item) {
                saveItem($item);
            }
        }

        return $list;
    }

    public function saveItem($item){
        if ($item -> id > 0){
            //Update or delete
            if ($item -> isDeleted == 1){
                $this -> dbAdapter -> deleteItem($item);
                $item = null;
            } else {
                $this -> dbAdapter -> updateItem($item);
            }
        } else {
            //Insert
            $item -> id = $this -> dbAdapter -> addItem($item, $item -> listId);
        }

        return $item;
    }
}