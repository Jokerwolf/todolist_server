<?php
require($_SERVER['DOCUMENT_ROOT'] .'/server/db/dto/TodoList.php');
require($_SERVER['DOCUMENT_ROOT'] .'/server/db/dto/TodoListItem.php');

class DB_Adapter {
    private $db_connection;
    private $user_id;

    public function __construct(mysqli $controller, $user_id){
        $this -> db_connection = $controller;
        $this -> user_id = $user_id;
    }

    private function bind_result_array($stmt)
    {
        $meta = $stmt -> result_metadata();
        $result = array();

        while ($field = $meta -> fetch_field())
        {
            $result[$field -> name] = NULL;
            $params[] = &$result[$field -> name];
        }
        call_user_func_array(array($stmt, 'bind_result'), $params);

        return $result;
    }

    private function getCopy($row)
    {
        return array_map(create_function('$a', 'return $a;'), $row);
    }


    /** Lists **/
    function getUserLists(){
        $stmt = $this -> db_connection -> prepare(
            "SELECT l.id AS list_id, l.title, i.id AS item_id, i.value, i.is_completed
             FROM lists l LEFT JOIN items i ON l.id = i.list_id AND (i.id is null OR i.is_deleted = 0)
             WHERE l.is_deleted = 0
             ORDER BY l.id");

        $result = [];

        if ($stmt -> execute()){
            $row = $this -> bind_result_array($stmt);
            if(!$stmt -> error)
            {
                while($stmt -> fetch()){
                    if (!array_key_exists($row['list_id'], $result)) {
                        //New list in the $row
                        $items = [];
                        if ($row['item_id'] != null) {
                            $items[$row['item_id']] = new TodoListItem($row['item_id'], $row['value'], $row['is_completed']);
                        }

                        $list = new TodoList($row['list_id'], $row['title'], $this -> user_id, $items);
                        $result[$list -> id] = $list;
                    } else {
                        //list already in the $result
                        if ($row['item_id'] != null) {
                            $result[$row['list_id']]->items[$row['item_id']] = new TodoListItem($row['item_id'], $row['value'], $row['is_completed']);
                        }
                    }
                }
            }
        }

        return $result;
    }

    function addList($list){
        $stmt = $this -> db_connection -> prepare("INSERT INTO lists
            (title, user_id)
            VALUES (?, ?)");

        $stmt -> bind_param('si', $list -> title, $this -> user_id);

        if ($stmt -> execute()){
            return $stmt -> insert_id;
        } else {
            echo $stmt -> error;
        }
    }

    function updateList($list){
        $stmt = $this -> db_connection -> prepare("UPDATE lists
            SET title = ?
            WHERE id = ?");

        $stmt -> bind_param('si', $list -> title, $list -> id);

        if ($stmt -> execute()){
        }
    }

    function deleteList($list){
        $stmt = $this -> db_connection -> prepare("UPDATE items
            SET is_deleted = 1 WHERE list_id = ?");

        $stmt -> bind_param('i', $list -> id);

        if ($stmt -> execute()){
        }

        $stmt = $this -> db_connection -> prepare("UPDATE lists
            SET is_deleted = 1 WHERE id = ?");

        $stmt -> bind_param('i', $list -> id);

        if ($stmt -> execute()){
        }
    }

    function addItem($item, $list_id){
        $stmt = $this -> db_connection -> prepare("INSERT INTO items
            (value, list_id, is_completed)
            VALUES (?, ?, ?)");

        $stmt -> bind_param('sii', $item -> text, $list_id, $item -> isDone);
        if ($stmt -> execute()){
            return $stmt -> insert_id;
        }
    }

    function updateItem($item){
        $stmt = $this -> db_connection -> prepare("UPDATE items
            SET value = ?, is_completed = ? WHERE id = ?");

        $stmt -> bind_param('sii', $item -> text, $item -> isDone, $item -> id);

        if ($stmt -> execute()){
        }
    }

    function deleteItem($item){
        $stmt = $this -> db_connection -> prepare("UPDATE items
            SET is_deleted = 1 WHERE id = ?");

        $stmt -> bind_param('i', $item -> id);

        if ($stmt -> execute()){
        }
    }

    /** Users **/
    public function login($username, $pwd){
        $stmt = $this -> db_connection -> prepare(
            "SELECT *
             FROM users
             WHERE username = ? AND password = ?");

        $stmt -> bind_param('ss', $username, $pwd);

        if ($stmt -> execute()){
            $row = $this -> bind_result_array($stmt);
            if(!$stmt -> error) {
                while($stmt -> fetch()){
                    if ($row['id']){
                        return true;
                    }
                }
            }
        }
        return false;
    }
}
?>
