<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/server/db/dto/DefaultEntity.php');

class TodoList extends DefaultEntity {
    public $title;
    public $items;
    public $user_id;

    public function __construct($id, $title, $user_id, $items){
        parent::__construct($id);

        $this -> title = $title;
        $this -> user_id = $user_id;
        $this -> items = $items;
    }
}