<?php

class AccountModel extends BaseModel{
    public function login($username, $pwd){
        return $this -> dbAdapter -> login($username, $pwd);
    }
}