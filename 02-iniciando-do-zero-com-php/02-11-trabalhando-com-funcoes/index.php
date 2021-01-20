<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("02.11 - Trabalhando com funções");

/*
 * [ functions ] https://php.net/manual/pt_BR/language.functions.php
 */
fullStackPHPClassSession("functions", __LINE__);
require __DIR__."/functions.php";
var_dump(functionName("Pearl Jam", "AC/DC", "After Bridge"));

echo "<h3>Optional Arguments</h3>";
var_dump(optionsArgs("Maykon"));
var_dump(optionsArgs("Maykon", "teste"));



/*
 * [ global access ] global $var
 */
fullStackPHPClassSession("global access", __LINE__);
$weight = 86;
$height = 1.83;

echo "<p>".calcImc()."</p>";


/*
 * [ static arguments ] static $var
 */
fullStackPHPClassSession("static arguments", __LINE__);

$pay = payTotal(20);
echo $pay;
$pay = payTotal(20);
echo $pay;
$pay = payTotal(20);
echo $pay;


/*
 * [ dinamic arguments ] get_args | num_args
 */
fullStackPHPClassSession("dinamic arguments", __LINE__);

var_dump(myTeam("Maykon", "Thomas", "Mateus"));