<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("02.04 - Variáveis e tipos de dados");

/**
 * [tipos de dados] https://php.net/manual/pt_BR/language.types.php
 * [ variáveis ] https://php.net/manual/pt_BR/language.variables.php
 * Escrever em camelCase e em inglês
 */
fullStackPHPClassSession("variáveis", __LINE__);

$userFirstName = "Maykon";
$userLastName = "Morais";

echo "<h3>{$userFirstName} {$userLastName}</h3>";

$userAge = "32";
echo "<p>{$userFirstName} {$userLastName} <span class='tag'> tem {$userAge} anos</span></p>";

$userEmail = "<p>maykons501@gmail.com</p>";
echo $userEmail;

// variável variável -> O valor de uma variável se torna a chave para uma outra variável
$company = "UpInside";
$$company = "Treinamentos";

echo "<h3>{$company} {$UpInside}</h3>";

$calA = 10;
$calB = 20;

//$calB = $calA;
$calB = &$calA; // passando referencia para a calcB, se eu fizer alguma alteração em A, afetará em B
$calA = 15;


var_dump([
    "a" => $calA,
    "b" => $calB
]);

/**
 * [ tipo boleano ] true | false
 */
fullStackPHPClassSession("tipo boleano", __LINE__);
$true = true;
$false = false;

var_dump($true, $false);

$bestAge = ($userAge  > 50);
var_dump($bestAge);


// falsitivy
$a = 0;
$b = 0.0;
$c = "";
$d = [];
$e = null;

if($a || $b || $c || $d || $e) {
    var_dump($true);
}
else {
    var_dump(false);
}

/**
 * [ tipo callback ] call | closure
 * Uma variável que nos retorna uma rotina ou um valor
 */
fullStackPHPClassSession("tipo callback", __LINE__);
$code = "<article><h1>Um call user function!</h1></article>";
$codeClear = call_user_func("strip_tags", $code);
var_dump($code, $codeClear);


$codeMore = function($code) {
    var_dump($code);
};


$codeMore("#BoraProgramar");
/**
 * [ outros tipos ] string | array | objeto | numérico | null
 */
fullStackPHPClassSession("outros tipos", __LINE__);

$string = "Olá, Mundo!";
$array = [$string];
$object = new stdClass();
$null = null;
$int = 3231;
$float =  2.131;


var_dump([
    $string,
    $array,
    $object,
    $null,
    $int,
    $float
]);
