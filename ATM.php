<?php

require('userClass.php');
require('check.php');

class ATM
{
    const ATM_ACTIONS = [
        "TOTAL"   => "0",
        "WITHDRAW" => "1",
        "DEPOSIT" => "2",
    ];

    const YES = "0";
    const NO = "1";
    private $total = 0;
    private $id;
    public $user;

    public function __construct()
    {
        $this->login();
    }

    public function login()
    {
        $id = $this->inputId();
        $user = User::getUserById($id);
        $confim_pass = $this->confirmPass($user);
        if ($confim_pass === true) {
            $this->user = $user;
            $this->id = $id;
        }
        $this->total = (int)$this->user["balance"];
        echo "login!!" . $this->user["name"] . "さん" . PHP_EOL . PHP_EOL;

        $this->main();
    }
    public function logout ()
    {
        $this->user = [];
        $this->login();
    }

    public function inputId()
    {
        echo "id入力 : ";
        $id = trim(fgets(STDIN));
        $exist = User::isExistByUserId($id);
        if ($exist === false) {
            echo "IDが存在しません" . PHP_EOL;
            return $this->inputId();
        }
        return $id;
    }

    public function confirmPass($user)
    {
        $user_pass = $user["password"];
        echo "password入力 : ";
        $input_pass = trim(fgets(STDIN));
        if ($input_pass !== $user_pass) {
            echo "passwordが違います" . PHP_EOL;
            return $this->confirmPass($user);
        }
        return true;
    }

    public function main()
    {
        
        $this->selectMenu();
        $continu = $this->continuing();
        if ($continu === true) {
            return $this->main();
        }
        if ($continu === false) {
            $total = $this->total;
            $id = $this->id;
            User::updateBalance($id, $total);
            echo "logout!!" . PHP_EOL;
            $this->logOut();
        }
    }

    public function selectMenu()
    {
        echo "残高照会=>'0'" . PHP_EOL;
        echo "引き出し=>'1'" . PHP_EOL;
        echo "預け入れ=>'2'" . PHP_EOL;
        $select = $this->inputAction();
        $check = selectMenuValidation::check($select);
        if ($check === false) {
            return $this->selectMenu();
        }
        switch ($select) {
            case self::ATM_ACTIONS["TOTAL"]:
                $this->showTotal();
                break;

            case self::ATM_ACTIONS["WITHDRAW"]:
                $this->withdraw();
                break;

            case self::ATM_ACTIONS["DEPOSIT"]:
                $this->deposit();
                break;
        }
    }

    public function inputAction()
    {
        $select = trim(fgets(STDIN));
        return $select;
    }

    public function showTotal()
    {
        echo "残高照会" . PHP_EOL;
        echo "¥" . $this->total . PHP_EOL;
    }

    public function withdraw()
    {
        echo "引き出し" . PHP_EOL;
        echo "金額を入力 : ¥";
        $money = (int)trim(fgets(STDIN));
        $total = $this->total;
        $check = withdrawValidation::check($money, $total);
        if ($check === false) {
            return $this->withdraw();
        }
        $this->total -= $money;
    }


    public function deposit()
    {
        echo "預け入れ" . PHP_EOL;
        echo "金額を入力 : ¥";
        $money = (int)trim(fgets(STDIN));
        $check = depositValidation::check($money);
        if ($check === false) {
            return $this->deposit();
        }
        $this->total += $money;
    }

    public function continuing()
    {
        echo "続けて操作" . PHP_EOL;
        echo "YES => '0'" . PHP_EOL;
        echo "LogOut  => '1'" . PHP_EOL;
        $continu = trim(fgets(STDIN));
        $check = continuingValidation::check($continu);
        if ($check === false) {
            return $this->continuing();
        }
        if ($continu === self::YES) {
            return true;
        }
        if ($continu === self::NO) {
            return false;
        }
    }

}
