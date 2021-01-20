<?php
//session_start();
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.12 - Cookies e sessões");

/*
 * [ cookies ] http://php.net/manual/pt_BR/features.cookies.php
 */
fullStackPHPClassSession("cookies", __LINE__);


setcookie("fsphp", "Esse é meu cookie", time() + 60); // criação do cookie
//setcookie("fsphp", null, time() - 60); // forçar deleção do cookie

$cookie = filter_input_array(INPUT_COOKIE, FILTER_SANITIZE_STRIPPED);
var_dump($_COOKIE, $cookie);

// criar intervalos de tempo
$time = time() + 60 * 60 * 24 * 7;
$user = [
    "user" => "root",
    "passwd"  => "123456",
    "expire" => $time
];

setcookie("fslogin", http_build_query($user), $time, "/", "www.localhost", true);

$login = filter_input(INPUT_COOKIE, "fslogin", FILTER_SANITIZE_STRIPPED);

if($login) {
    var_dump($login);
//    echo "<p>{$login}</p>";
}

/*
 * [ sessões ] http://php.net/manual/pt_BR/ref.session.php
 */
fullStackPHPClassSession("sessões", __LINE__);

session_save_path(__DIR__."/ses");
session_start([
    "cookie_lifetime" => (60 * 60 * 24),
]);

var_dump($_SESSION); // LEMBRAR DE SEMPRE INICIALIZAR A SESSÃO NO INÍCIO DO ARQUIVO

$_SESSION['login'] = (object)$user;