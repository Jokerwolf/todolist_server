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
             FROM lists l LEFT JOIN items i ON l.id = i.list_id
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

        //var_dump($result);
        return $result;
    }

    function addList($list){
        $stmt = $this -> db_connection -> prepare("INSERT INTO lists
            (title, user_id)
            VALUES (?, ?)");

        $stmt -> bind_param('si', $title, $user_id);
        $title = $list -> title;
        $user_id = $this -> user_id;

        if ($stmt -> execute()){
            echo 'Added <br />';
        }

    }

    function updateList($list){
        $stmt = $this -> db_connection -> prepare("UPDATE lists
            SET title = ?
            WHERE id = ?");

        $stmt -> bind_param('si', $title, $list_id);
        $title = $list -> title;
        $list_id = $list -> id;

        if ($stmt -> execute()){
            echo 'Updated <br />';
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
