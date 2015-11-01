<?php
/**
 * Created by PhpStorm.
 * User: jokerwolf
 * Date: 01/11/15
 * Time: 12:56
 */

class ViewModel {
    //dynamically adds a property or method to the ViewModel instance
    public function set($name, $val) {
        $this -> $name = $val;
    }

    //returns the requested property value
    public function get($name) {
        if (isset($this -> { $name })) {
            return $this -> { $name };
        } else {
            return null;
        }
    }
}