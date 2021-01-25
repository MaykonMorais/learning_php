<?php

use Source\Core\Message;

require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("06.08 - Camada de manipulação pt3");

require __DIR__ . "/../source/autoload.php";

/*
 * [ validate helpers ] Funções para sintetizar rotinas de validação
 */
fullStackPHPClassSession("validate", __LINE__);

$message = new Message();

$email = "cursos@ufersa.com.br";

if(!is_email($email)) {
  echo $message->error("Email inválido");
} 
else {
  echo $message->success("Email válido");
}

$passwd = 12345678;

if(!is_passwd($passwd)) {
  echo $message->error("Senha Inválida");
}
else {
  echo $message->success("Senha Válida");
}



/*
 * [ navigation helpers ] Funções para sintetizar rotinas de navegação
 * Compor urls e realizar redirecionamentos
 */
fullStackPHPClassSession("navigation", __LINE__);

var_dump([
  url("/blog/titulo-do-artigo"),
  url("blog/titulo-do-artigo")
]);

if(empty($_GET)) {
  redirect("?f=true");
}
/*
 * [ class triggers ] São gatilhos globais para criação de objetos
 */
fullStackPHPClassSession("triggers", __LINE__);

var_dump([
  user()->load(1)
]);


echo message()->error("Esse é um erro");

session()->set("user", user()->load(1));

var_dump(session()->all());

