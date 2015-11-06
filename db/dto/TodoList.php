<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/server/db/dto/DefaultEntity.php');

class TodoList extends DefaultEntity {
    public $title;
    public $items;
    private $user_id;

    public function __construct($id, $title, $user_id, $items){
        parent::__construct($id);

        $this -> title = $title;
        $this -> user_id = $user_id;
        $this -> items = $items;
    }

    public function getTitle(){
        return $this -> title;
    }

    public function setTitle($title){
        $this -> title = $title;
    }
}