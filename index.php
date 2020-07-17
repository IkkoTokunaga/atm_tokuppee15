<?php
const ATM_ACTIONS = [
    "TOTAL"   => "0",
    "WITHDRAW" => "1",
    "DEPOSIT" => "2",
];
const YES = "0";
const NO = "1";

require('ATM.php');

$total = 0;
$total = main($total);

function main($total)
{
    

    echo "残高照会=>'0'" . PHP_EOL;
    echo "引き出し=>'1'" . PHP_EOL;
    echo "預け入れ=>'2'" . PHP_EOL;
    $select = trim(fgets(STDIN));
    
    if (check($select) === false) {
        return main($total);
    }
    if ($select === ATM_ACTIONS["TOTAL"]){
        $show_total = new ATM($total);
        $show_total->showTotal();
    }
    if ($select === ATM_ACTIONS["WITHDRAW"]){
        $withdraw = new ATM($total);
        $total = $withdraw->withdraw();
    }
    if ($select === ATM_ACTIONS["DEPOSIT"]){
        $deposit = new ATM($total);
        $total = $deposit->deposit();
    }

    $continu = continuing();
    if ($continu === YES) {
        return main($total);
    } 
    elseif ($continu === NO) {
        echo "終了" . PHP_EOL;
        exit;
    }
    
}

function check ($select)
{
    if(array_search($select,ATM_ACTIONS) === false) {
        echo "【　入力ミス　】" . PHP_EOL;
        return false;
    }
}

function continuing()
{
    echo "続けて操作" . PHP_EOL;
    echo "YES => '0'" . PHP_EOL;
    echo "NO  => '1'" . PHP_EOL;
    $continu = trim(fgets(STDIN));
    if ($continu === YES || $continu  === NO) {
        return $continu;
    }
    echo "'YES'か'NO'を選択" . PHP_EOL;
    return continuing();
    
}