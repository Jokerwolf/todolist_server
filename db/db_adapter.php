<?php
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


    function getUserLists(){
        $stmt = $this -> db_connection -> prepare("SELECT *
            FROM lists WHERE is_deleted = 0");

        $result = [];

        if ($stmt -> execute()){
            $row = $this -> bind_result_array($stmt);
            if(!$stmt -> error)
            {
                while($stmt -> fetch()){

                }
            }
        }
    }


    function addList($list){
        $stmt = $this -> db_connection -> prepare("INSERT INTO lists
            (title, user_id)
            VALUES (?, ?)");

        $stmt -> bind_param('si', $title, $user_id);
        $title = $list -> getTitle();
        $user_id = $this -> user_id;

        if ($stmt -> execute()){
            echo 'Added <br />';
        }

    }
}
?>
