<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("02.03 - Comandos de saída");

/**
 * [ echo ] https://php.net/manual/pt_BR/function.echo.php
 */
fullStackPHPClassSession("echo", __LINE__);

echo "<p>Olá, Mundo!", " <span class='tag'>#BoraProgramar</span>", "</p>";

$hello = "Olá, Mundo!";
$code = "<span class='tag'>#BoraProgramar</span>";

echo '<p>$hello</p>';


$day = "dia";
$days = "Dias";
echo "<p>Falta 1 $day para o evento!</p>";
echo "<p>Faltam 2 {$day}s para o evento!</p>";

// proteção de variáveis
echo "<h3>{$hello}</h3>";
echo "<h4>{$hello} {$code}</h4>";

// concatenação de strings
echo '<h3>' . $hello . " " .$code . "</h3>";

/**
 * [ print ] https://php.net/manual/pt_BR/function.print.php
 */
fullStackPHPClassSession("print", __LINE__);
print $hello;
print $code;

/**
 * [ print_r ] https://php.net/manual/pt_BR/function.print-r.php
 * Usado somente para printar arrays
 */
fullStackPHPClassSession("print_r", __LINE__);

$array = [
    "company" =>  "UpInside",
    "course" => "FSPHP",
    "class" => "Comandos de saida"
];

print_r($array);
echo "<pre>", print_r($array, true), "</pre";

/**
 * [ printf ] https://php.net/manual/pt_BR/function.printf.php
 * print com formatação específica
 */
fullStackPHPClassSession("printf", __LINE__);
$article  = "<article> <h1>%s</h1><p>%s</p> </article>";
$title = "{$hello} {$code}";
$subtitle = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eu elementum mauris. Etiam sodales, ex at ultricies
 molestie, lacus enim viverra eros, sed hendrerit risus dolor at nibh. Donec vitae tincidunt orci. Sed eget imperdiet felis. 
 Vivamus vehicula felis neque, at dapibus magna hendrerit sit amet. Ut vel libero vitae neque vehicula ultrices.";

printf($article, $title, $subtitle);


/**
 * [ vprintf ] https://php.net/manual/pt_BR/function.vprintf.php
 * vector print f
 */
fullStackPHPClassSession("vprintf", __LINE__);
$company = "<article><h1>Escola %s</h1><p>Curso <b>%s</b>, Aula<b>%s</b></p></article>";
vprintf($company, $array);


/**
 * [ var_dump ] https://php.net/manual/pt_BR/function.var-dump.php
 */
fullStackPHPClassSession("var_dump", __LINE__);

var_dump(
    $array,
    $hello,
    $code
);