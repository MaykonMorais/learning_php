<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("05.09 - Métodos de busca e leitura");

require __DIR__ . "/../source/autoload.php";

/*
 * [ load ] Por primary key (id)
 */
fullStackPHPClassSession("load", __LINE__);

$model = new \Source\Models\User();

$user = $model->load(1);

var_dump($user);

echo "<p class='trigger'>{$user->first_name} {$user->last_name}</p>";


/*
 * [ find ] Por indexes da tabela (email)
 */
fullStackPHPClassSession("find", __LINE__);

$user = $model->find("mateus31@email.com.br");
var_dump($user);

echo "<p class='trigger'>{$user->first_name} {$user->last_name}</p>";


/*
 * [ all ] Retorna diversos registros
 */
fullStackPHPClassSession("all", __LINE__);

$all = $model->all(5 );

var_dump($all);

foreach ($all as $user) {
    echo "<p class='trigger'>{$user->first_name} {$user->last_name}</p>";
}