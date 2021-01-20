<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.11 - Contratos com interfaces");

require __DIR__ . "/source/autoload.php";

use Source\Contracts\User;
use Source\Contracts\UserAdmin;
use Source\Contracts\Login;

/*
 * [ implementacão ] Um contrato de quais métodos a classe deve implementar
 * http://php.net/manual/pt_BR/language.oop5.interfaces.php
 */
fullStackPHPClassSession("implementacão", __LINE__);

$user = new User("Maykon", "Morais", "maykons501@gmail.com");

var_dump($user);

$admin = new \Source\Contracts\UserAdmin("Gustavo", "Guanabara", "gus@curso.com.br");

var_dump("<p></p>", $admin);
/*
 * [ associação ] Um exemplo associando ao login
 */
fullStackPHPClassSession("associação", __LINE__);

$login = new Login();

//$loginUser = $login->loginUser($user);
//$loginAdmin= $login->loginAdmin($admin);


//var_dump($loginUser, "<p></p>", $loginAdmin);



/*
 * [ dependência ] Dependency Injection ou DI, é um contrato de relação entre objetos, onde
 * um método assina seus atributos com uma interface.
 */
fullStackPHPClassSession("dependência", __LINE__);


var_dump(
//    $login->login($user),
    $login->login($user)->getFirstName(),
//    $login->login($admin),
    $login->login($admin)->getFirstName()

);


