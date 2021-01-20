<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.02 - Funções para strings");

/*
 * [ strings e multibyte ] https://php.net/manual/en/ref.mbstring.php
 * O multibyte é usado para manipularmos strings com acentos e símbolos especiais
 */
fullStackPHPClassSession("strings e multibyte", __LINE__);

$string = "The last ac/dc concert was incredible!";
$stringOne = "O último show do ac/dc foi incrível";

var_dump([
    "string" => $string,
    "strlen" => strlen($stringOne),
    "mb_strlen" => mb_strlen($stringOne), // cada caractere é contado como somente um (recomendado usar)
    "substr" => substr($stringOne, "10"), // forma uma nova string a partir do offset(posição) dado
    "mb_substr" => mb_substr($stringOne, "9"),
    "strtoupper" => strtoupper($stringOne),
    "mb_strtoupper" => mb_strtoupper($string)
]);
/**
 * [ conversão de caixa ] https://php.net/manual/en/function.mb-convert-case.php
 */
fullStackPHPClassSession("conversão de caixa", __LINE__);

$mbString = $stringOne;

var_dump([
    "mb_strtoupper" => mb_strtoupper($mbString),
    "mb_strtolower" => mb_strtolower($mbString),
    "mb_convert_case UPPER" => mb_convert_case($mbString, MB_CASE_UPPER),
    "mb_convert_case LOWER" => mb_convert_case($mbString, MB_CASE_LOWER),
    "mb_convert_case TITLE" => mb_convert_case($mbString, MB_CASE_TITLE)
]);

/**
 * [ substituição ] multibyte and replace
 */
fullStackPHPClassSession("substituição", __LINE__);

$mbReplace = $mbString. " Fui, iria novamente, e foi épico";

var_dump([
    "mb_strlen" => mb_strlen($mbReplace), // tamanho da string
    "mb_strpos" => mb_strpos($mbReplace, ", "), // posição de um caractere
    "mb_strrpos" => mb_strrpos($mbReplace, ", "), // posição do último caractere mais a direita
    "mb_substr" => mb_substr($mbReplace, 39 + 2, 14), // retorna uma substring a partir de uma original,
    "mb_strstr" => mb_strstr($mbReplace, ", ", true),// retorna a substring a partir da string
    "mb_strrchr" => mb_strrchr($mbReplace, ", ")
]);

$mbReplace = $string;
echo "<h3></h3>";

echo "<p>", $string , "</p>";
echo "<p>", str_replace("ac/dc", "Nirvana", $mbReplace) , "</p>";
echo "<p>", str_replace(["ac/dc", "last"], ["Nirvana", "new"], $mbReplace) , "</p>";

// delimitador
$article = <<<ROCK
    <article>
        <h3>event</h3>
        <p>desc</p>
    </article>
ROCK;

$articleData = [
    "event" => "Rock in Rio",
    "desc" =>  $mbReplace
];

echo str_replace(array_keys($articleData), array_values($articleData), $article);

/**
 * [ parse string ] parse_str | mb_parse_str
 * Interpretar requisição HTTP/ Requisição de uma API
 */
fullStackPHPClassSession("parse string", __LINE__);

$endPoint = "name=Maykon&email=maykons501@gmail.com";
mb_parse_str($endPoint, $parseEndpoint);

var_dump([
    $endPoint,
    $parseEndpoint
]);