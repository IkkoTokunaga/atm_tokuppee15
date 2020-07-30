<?php

class selectMenuValidation {

    public static function check ($select)
    {
        if (array_search($select, ATM::ATM_ACTIONS) === false) {
            echo "【　入力ミス　】" . PHP_EOL;
            return false;
        }
        return true;
    }
}

const UPPER_LIMIT = 100000;

class withdrawValidation {

    public static function check ($money, $total) 
    {
        if ($money < 1) {
            echo "【　入力ミス　】" . PHP_EOL;
            return false;
        }
        if ($total - $money < 0) {
            echo "【　残高不足　】" . PHP_EOL;
            return false;
        }
        if ($money > UPPER_LIMIT) {
            echo "【　limit over!!　】" . PHP_EOL;
            return false;
        }
        return true;

    }
}

class depositValidation {

    public static function check ($money) 
    {
        if ($money < 1) {
            echo "【　入力ミス　】" . PHP_EOL;
            return false;
        }
        if ($money > UPPER_LIMIT) {
            echo "【　limit over!!　】" . PHP_EOL;
            return false;
        }
        return true;
    }

}

class continuingValidation {

    public static function check ($continu) 
    {
        if ($continu === ATM::YES){
            return true;
        }
        if ($continu === ATM::NO){
            return true;
        }
        echo "【　入力ミス　】" . PHP_EOL;
        return false;
    }

}
