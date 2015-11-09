<?php
/**
 * Created by PhpStorm.
 * User: jokerwolf
 * Date: 10/11/15
 * Time: 00:56
 */

require_once($_SERVER['DOCUMENT_ROOT'] .'/server/db/dto/DefaultEntity.php');

class TodoListItem extends DefaultEntity {
    public $value;
    public $is_completed;

    public function __construct($id, $value, $is_completed = false){
        parent::__construct($id);

        $this -> value = $value;
        $this -> is_completed = $is_completed;
    }
}

?>