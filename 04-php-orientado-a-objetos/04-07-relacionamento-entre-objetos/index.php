<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.07 - Relacionamento entre objetos");

require __DIR__ . "/source/autoload.php";

/*
 * [ associacão ] É a associação mais comum entre objetos onde o objeto terá um atributo
 * apontando e dando acesso ao outro objeto
 */
fullStackPHPClassSession("associacão", __LINE__);
$company = new \Source\Related\Company();
//$company->bootCompany("UpInside", "Nome da Rua");

$address = new \Source\Related\Address("José de Souza", 222, "AP B");
$company->boot("UpInside", $address);

//var_dump($company);

echo "<p>A variável {$company->getCompany()} tem sede na rua {$company->getAddress()->getStreet()}</p>";
/*
 * [ agregação ] Em agregação tornamos um objeto externo parte do objeto base, contudo não
 * o referenciamos em uma propriedade como na associação.
 */
fullStackPHPClassSession("agregação", __LINE__);

$fsphp = new \Source\Related\Product("Full Stack PHP", 1997);
$laradev = new \Source\Related\Product("Laravel Developer", 997);

//var_dump($fsphp, "<p></p>", $laradev);

$company->addProduct($fsphp);
$company->addProduct($laradev);
$company->addProduct(new \Source\Related\Product("Scrum with masters", 999));

//var_dump($company);

/**
 * @var \Source\Related\Product $product
 */

foreach ($company->getProducts() as $product) {
    echo "<p>{$product->getName()} por R$ {$product->getPrice()}</p>";
}


/*
 * [ composição ] Em composição temos um objeto base que é responsável por instanciar o
 * objeto parte, que só existe enquanto o base existir.
 */
fullStackPHPClassSession("composição", __LINE__);

$company->addTeamMember("CEO", "Maykon", "Morais");
$company->addTeamMember("Manager", "Raquel", "Torquato");
$company->addTeamMember("Support", "Livia", "Menezes");
$company->addTeamMember("Producer", "Gustavo", "Santos");
$company->addTeamMember("Designer", "João", "Almeida");

var_dump($company);

/**
 * @var \Source\Related\User $person
 */
foreach ($company->getTeam() as $person) {
    echo "<p>{$person->getFirstName()} é o {$person->getJob()}</p>";
}










