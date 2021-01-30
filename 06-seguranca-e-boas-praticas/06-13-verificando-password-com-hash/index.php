<?php

use Source\Models\User;

require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("06.13 - Verificando password com hash");

require __DIR__ . "/../source/autoload.php";

/*
 * [ hash ]
 */
fullStackPHPClassSession("hash", __LINE__);

$user = (new User())->findById(1);

$user->password = 12345678;
$user->save();

var_dump(
  $user
);