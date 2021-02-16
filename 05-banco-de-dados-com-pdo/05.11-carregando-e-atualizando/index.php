<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("05.11 - Carregando e atualizando");

require __DIR__ . "/../source/autoload.php";

/*
 * [ save update ] Salvar o usuário ativo (Active Record)
 */
fullStackPHPClassSession("save update", __LINE__);

$model = new \Source\Models\User();
$user = $model->load(1);

if($user) {
    $user->first_name = "Maria";
    $user->email = "maria@gmail.com";

    $user->save();

    //var_dump($user);

}
else {
    echo "<p class='trigger error'>User not found</p>";
}

