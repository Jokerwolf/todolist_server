<?php
require_once ($_SERVER['DOCUMENT_ROOT'] .'/db/db_connection.php');

class DB_Controller {
    private static $db_instance;

    private function __construct(){

    }

    public static function call(){
        if (self::$db_instance == null){
            self::$db_instance = new mysqli(HOST, USERNAME, PWD, DBNAME);
            if (self::$db_instance -> connect_errno) {
                echo "Failed to connect to MySQL: (" .self::$db_instance -> connect_errno. ") "
                    .self::$db_instance -> db_instance -> connect_error;
            }
        }

        return self::$db_instance;
    }
}
?>
