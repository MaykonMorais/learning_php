<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.10 - Fundamentos da abstração");

require __DIR__ . "/source/autoload.php";

use Source\App\User;
use Source\Bank\AccountSaving;
use Source\Bank\AccountCurrent;
/*
 * [ superclass ] É uma classe criada como modelo e regra para ser herdada por outras classes,
 * mas nunca para ser instanciada por um objeto.
 */
fullStackPHPClassSession("superclass", __LINE__);

$client = new User("Maykon", "Morais");

//$account = new Account("1600", "22345", $client, "1000");
//
//var_dump($account,"<p></p>", $client);

/*
 * [ especialização ] É uma classe filha que implementa a superclasse e se especializa
 * com suas prórpias rotinas
 */
fullStackPHPClassSession("especialização.a", __LINE__);

$saving = new AccountSaving("1655", "22456", $client, "0");

var_dump($saving);

$saving->deposit(1000);
$saving->withdrawal(1000);
$saving->withdrawal(6);

$saving->extract();

/*
 * [ especialização ] É uma classe filha que implementa a superclass e se especializa
 * com suas prórpias rotinas
 */
fullStackPHPClassSession("especialização.b", __LINE__);

$current = new AccountCurrent("1655", "19283", $client, "1000", "1000");

var_dump($current);

$current->deposit("1000");

$current->withdrawal(2000);
$current->withdrawal(500);

$current->extract();