<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.12 - Comportamentos com traits");

require __DIR__ . "/source/autoload.php";

/*
 * [ trait ] São traços de código que podem ser reutilizados por mais de uma classe. Um trait é como um compoetamento
 * do objeto (BEHAVES LIKE). http://php.net/manual/pt_BR/language.oop5.traits.php
 */
fullStackPHPClassSession("trait", __LINE__);

$user = new \Source\Traits\User("Maykon", "Morais", "maykons501@gmail.com");
$address = new \Source\Traits\Address("José de Sousa", 222, "AP-B");

$register = new \Source\Traits\Register(
  $user,
  $address
);

var_dump([
        "Nome" => $register->getUser()->getFirstName(),
        "Rua"=> $register->getAddress()->getStreet()
]);


// exemplo

$cart = new \Source\Traits\Cart();
$cart->add(1, "Full Stack PHP Developer", 1 ,2000);
$cart->add(2, "Laravel Developer", 2 ,1000);
$cart->add(3, "WS PHP", 5, 500);

$cart->remove(2, 1);
$cart->remove(3, 5);

echo "<h3></h3>";

var_dump($cart);