<?php

use Source\Models\User;

require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("06.12 - Efetuando cadastro de usuário");

require __DIR__ . "/../source/autoload.php";

/*
 * [ register ] Uma rotina de cadastro blindada contra ataques XSS e CSRF.
 */
fullStackPHPClassSession("register", __LINE__);


$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

if($post) {
  $data = (object)$post;

  if(!csrf_verify($post)) {
    $error = message()->error("Erro ao enviar, tente novamente mais tarde");
  } else {
    $user = new User();

    $user->bootstrap(
      $data->first_name,
      $data->last_name,
      $data->email,
      $data->password
    );

    if(!$user->save()) {
      echo $user->message();
    } else {
      echo message()->success("Cadastro realizado com sucesso!");

     // unset($data);
    }

    var_dump($user->data);
  }

  //var_dump($data);
}
require __DIR__."/form.php";
