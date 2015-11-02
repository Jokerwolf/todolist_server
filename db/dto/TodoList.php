<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/server/db/dto/DefaultEntity.php');

class TodoList extends DefaultEntity {
    private $title;
    private $user_id;

    public function __construct($id, $title, $user_id){
        parent::__construct($id);

        $this -> title = $title;
        $this -> user_id = $user_id;
    }

    public function getTitle(){
        return $this -> title;
    }

    public function setTitle($title){
        $this -> title = $title;
    }
}