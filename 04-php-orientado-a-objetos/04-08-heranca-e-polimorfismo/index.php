<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.08 - Herança e polimorfismo");

require __DIR__ . "/source/autoload.php";

/*
 * [ classe pai ] Uma classe que define o modelo base da estrutura da herança
 * http://php.net/manual/pt_BR/language.oop5.inheritance.php
 */
fullStackPHPClassSession("classe pai", __LINE__);

$event = new \Source\Inheritance\Event\Event(
    "Workshop FSPHP",
    new DateTime("2021-06-22 16:00"),
    2500,
    "4"
);

var_dump($event);

$event->register("Maykon Morais", "maykons501@gmail.com");
$event->register("Raquel Torquato", "maykons501@gmail.com");
$event->register("Breno de Barros", "maykons501@gmail.com");
$event->register("Jota Junior", "maykons501@gmail.com");
$event->register("Lívia Barroso", "maykons501@gmail.com");

/*
 * [ classe filha ] Uma classe que herda a classe pai e especializa seuas rotinas
 */
fullStackPHPClassSession("classe filha", __LINE__);

$address = new \Source\Inheritance\Address("José de Souza", 222);
$event = new \Source\Inheritance\Event\EventLive(
    "Workshop FSPHP",
    new DateTime("2021-06-22 16:00"),
    2500,
    "4",
    $address
);

var_dump($event);
/*
 * [ polimorfismo ] Uma classe filha que tem métodos iguais (mesmo nome e argumentos) a class
 * pai, mas altera o comportamento desses métodos para se especializar
 */
fullStackPHPClassSession("polimorfismo", __LINE__);

$event = new \Source\Inheritance\Event\EventOnline(
    "Workshop FSPHP",
    new DateTime("2021-06-22 16:00"),
    2500,
    "https://upinside.com.br/aovivo"
);

$event->register("Maykon Morais", "maykons501@gmail.com");
$event->register("Raquel Torquato", "maykons501@gmail.com");
$event->register("Breno de Barros", "maykons501@gmail.com");
$event->register("Jota Junior", "maykons501@gmail.com");
$event->register("Lívia Barroso", "maykons501@gmail.com");

