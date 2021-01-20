<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("02.09 - Closures e generators");

/*
 * [ closures ] https://php.net/manual/pt_BR/functions.anonymous.php
 * Executar um determinado trecho de código que precisa ser repetido no software
 */
fullStackPHPClassSession("closures", __LINE__);

$myAge = function($year) {
    $age = date("Y") - $year;

    return "<p>Você tem {$age} anos!</p>";
};

echo $myAge(1998);

echo $myAge(2000);
echo $myAge(2001);
echo $myAge(2005);


$priceBrl = function($price) {
  return number_format($price, 2, ",", ".");
};

echo "<p>O projeto custa R$ {$priceBrl(3600)}. Vamos fechar? </p>";

$myCart = [
  "totalPrice" => 0,
];

$cardAdd = function($item, $qtd, $price) use(&$myCart) {
    $myCart[$item] = $qtd * $price;
    $myCart["totalPrice"] += $myCart[$item];
};

$cardAdd("HTML5", 1, 497);
$cardAdd("JQuery", 2, 497);

var_dump($myCart, $cardAdd);

/*
 * [ generators ] https://php.net/manual/pt_BR/language.generators.overview.php
 * Iterar sobre objetos sem usar recursos de memória
 */
fullStackPHPClassSession("generators", __LINE__);

$iterator = 40000;

function showDates($days) {
    $saveDate = [];

    for($day = 1; $day <= $days; $day++) {
        $saveDate[] = date("d/m/Y", strtotime("+{$day}days"));
    }
    return $saveDate;
}

echo "<div style='text-align: center'>";
    foreach (showDates($iterator) as $date) {
        echo "<small class='tag'>{$date}</small>";
    }
echo "</div>";

function generatorDate($days) {
    for($day = 1; $day < $days; $day++) {
        yield date('d/m/Y', strtotime("+{$day}days"));
    }
}

echo "<div style='text-align: center'>";
foreach (generatorDate($iterator) as $date) {
    echo "<small class='tag'>{$date}</small>".PHP_EOL;
}
echo "</div>";