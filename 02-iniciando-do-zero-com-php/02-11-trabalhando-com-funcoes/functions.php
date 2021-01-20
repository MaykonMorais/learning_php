<?php
function functionName($arg1, $arg2, $arg3) {
    $body = [$arg1, $arg2, $arg3];
    return $body;
}

function optionsArgs($arg1, $arg2 = true, $arg3 = null)  {
    $body = [$arg1, $arg2, $arg3];
    return $body;
}

function calcImc() {
    global $weight;
    global $height;

    return $weight / (pow($height, 2));
}

// variaveis com static type ficam salvas na memória
function payTotal($price) {
    static $total;

    $total += $price;
    return "<p>Total to pay: R$".number_format($total, "2", ",", ".")."</p>";
}

// argumentos dinamicos, descarta a possibilidade de criação de vários argumentos
function myTeam() {
    $teamNames = func_get_args();
    $teamCount = func_num_args();

    return ["members" => $teamNames, "count" => $teamCount];
}