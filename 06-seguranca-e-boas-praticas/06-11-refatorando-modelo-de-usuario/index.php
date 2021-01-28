<?php

use Source\Models\User;

require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("06.11 - Refatorando modelo de usuário");

require __DIR__ . "/../source/autoload.php";

/*
 * [ find ]
 */
fullStackPHPClassSession("find", __LINE__);

$model = new User();
$user = $model->find("id = :id", "id=1");

var_dump($user);


/*
 * [ find by id ]
 */
fullStackPHPClassSession("find by id", __LINE__);

$user = $model->findById(2);
var_dump($user);

/*
 * [ find by email ]
 */
fullStackPHPClassSession("find by email", __LINE__);

$user->findByEmail("sidney38@email.com.br");
var_dump($user);

/*
 * [ all ]
 */
fullStackPHPClassSession("all", __LINE__);

$list = $model->all(2, 5);
var_dump($list);

/*
 * [ save ]
 */
fullStackPHPClassSession("save create", __LINE__);


$user = $model->bootstrap(
  "Robson",
  "Leite",
  "cursos@upinside.com.br",
  "21821a1828"
);

if($user->save()) {
  echo message()->success("Usuário criado com sucesso!");
} else {
  echo $user->message();
  echo message()->info($user->message()->json());
}


/*
 * [ save update ]
 */
fullStackPHPClassSession("save update", __LINE__);

$user = (new User())->findById(51);

$user->first_name = "Gustavo";
$user->last_name = "Sampaio";

$user->password = passwd("1929sa245");

if($user->save()) {
  echo message()->success("Dados atualizados com sucesso!");
} else {
  echo message()->info($user->message()->json());
}

var_dump($user);