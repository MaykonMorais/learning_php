<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("06.05 - Uma única interface de erros");

require __DIR__ . "/../source/autoload.php";

/*
 * [ message class ] Uma classe padrão para reportar ao usuário
 */
fullStackPHPClassSession("message class", __LINE__);

$message = new \Source\Core\Message();
var_dump($message, get_class_methods($message));

/*
 * [ message types ] Métodos para cada tipo de mensagem
 */
fullStackPHPClassSession("message types", __LINE__);

$error = $message->success("This is a success message");

var_dump([
    $message->getText(),
    $message->getType()
]);


echo $message->info("This a render message");
echo $message->warning("This a render message");
echo $message->success("This a render message");
echo $message->error("This a render message");


/*
 * [ json message ] Mudando o padrão de retorno
 */
fullStackPHPClassSession("json message", __LINE__);

echo $message->warning("This a render message")->json();

/*
 * [ flash message ] Uma mensagem via sessão para refresh de navegação
 */
fullStackPHPClassSession("flash message", __LINE__);
$session = new \Source\Core\Session();

$message->success("This is a flash message")->flash();

if ($flash = $session->flash()) {
    echo $flash;
}

//echo $_SESSION['flash'];
