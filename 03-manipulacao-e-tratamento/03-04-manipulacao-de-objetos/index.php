<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.04 - Manipulação de objetos");

/*
 * [ manipulação ] http://php.net/manual/pt_BR/language.types.object.php
 *
 */
fullStackPHPClassSession("manipulação", __LINE__);

$arrProfile = [
    "name" => "Maykon",
    "company" => "UFERSA",
    "mail"  => "maykons501@gmail.com"
];

$objProfile = (object) $arrProfile;

echo "<p>{$arrProfile['name']} trabalha na {$arrProfile['company']}</p>";
echo "<p>{$objProfile->name} trabalha na {$objProfile->company}</p>";

$ceo = $objProfile;

unset($objProfile->company); // eliminar um atributo do objeto
var_dump($ceo);

echo "<h5>Criando um objeto a partir do StdClass</h5>";

$company = new stdClass();
$company->company = "UFERSA";
$company->ceo = $ceo;
$company->mananger = new stdClass();
$company->mananger->name = "Ludimilla";
$company->mananger->mail = "ludi.milla@ufersa.edu.br";

var_dump($company);

/**
 * [ análise ] class | objetcs | instances
 */
fullStackPHPClassSession("análise", __LINE__);

$date = new DateTime();

var_dump([
    "class" => get_class($date), // retorna o nome da classe a qual objeto pertence
    "methods" => get_class_methods($date), // métodos de uma classe
    "vars" =>  get_object_vars($date), // variáveis de uma class
    "parents" => get_parent_class($date), // não possui herança
    "subclass" => is_subclass_of($date, "DateTime") // verifica se determinada classe é subclasse de alguma outra
]);

echo "<p></p>";
$expetion = new PDOException();

var_dump([
    "class" => get_class($expetion),
    "methods" => get_class_methods($expetion),
    "vars" => get_object_vars($expetion),
    "parents" => get_parent_class($expetion),
    "subclass" => is_subclass_of($expetion, "Exception")
]);