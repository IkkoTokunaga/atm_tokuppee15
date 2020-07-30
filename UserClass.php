<?php

class User {
    public static $user_list = array(
        1 => array(
            "id" => "1",
            "password" => "1234",
            "name" => "tanaka",
            "balance" => "500000"
        ),
        2 => array(
            "id" => "2",
            "password" => "3456",
            "name" => "suzuki",
            "balance" => "1000000"
        )
    ); 

    public static function isExistByUserId ($id)
    {
        $exist = false;

        for ($i = 1; $i <= count(self::$user_list); $i++) {
            if ($id === self::$user_list[$i]["id"]) {
                $exist = true;
            }
        }
        return $exist;
    }
    public static function getUserById ($id)
    {
        $id = (int)$id;
        return self::$user_list[$id];
    }
    public static function updateBalance ($id, $total)
    {
        self::$user_list[$id]["balance"] = $total;
    }

    
}