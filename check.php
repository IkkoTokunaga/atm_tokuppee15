<?php

class validation {

    protected $error_msgs = [];
    const UPPER_LIMIT = 100000;

    public function getErrorMessages ()
    {
        foreach ($this->error_msgs as $error) {
            echo "【" . $error . "!!】" . PHP_EOL;
        }
    }

}
///親クラスを定義して継承してみました
class selectMenuValidation extends validation
{

    public function check($select)
    {
        if (array_search($select, ATM::ATM_ACTIONS) === false) {
            $this->error_msgs[] = '入力ミス';
        }
        if (empty($this->error_msgs)) {
            return true;
        } else {
            return false;
        }
    }
}

class withdrawValidation extends validation
{

    public function check($money, $total)
    {
        if (!is_numeric(($money))) {
            $this->error_msgs[] = '半角数字で入力';
        }
        if ($money < 1) {
            $this->error_msgs[] = '入力ミス';
        }
        if ($total - $money < 0) {
            $this->error_msgs[] = '残高不足';
        }
        if ($money > self::UPPER_LIMIT) {
            $this->error_msgs[] = '上限オーバー';
        }
        if (empty($this->error_msgs)) {
            return true;
        } else {
            return false;
        }
    }
}

class depositValidation extends validation
{

    public function check($money)
    {
        if (!is_numeric(($money))) {
            $this->error_msgs[] = '半角数字で入力';
        }
        if ($money < 1) {
            $this->error_msgs[] = '入力ミス';
        }
        if ($money > self::UPPER_LIMIT) {
            $this->error_msgs[] = '上限オーバー';
        }
        if (empty($this->error_msgs)) {
            return true;
        } else {
            return false;
        }
    }
}

class continuingValidation extends validation
{

    public function check($continu)
    {
        if ($continu === ATM::YES) {
            return true;
        }
        if ($continu === ATM::NO) {
            return true;
        }
        $this->error_msgs[] = '入力ミス';
        return false;
}
}
