 <?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.05 - Interpretação e operações pt1");

require __DIR__ . "/source/autoload.php";

/*
 * [ construct ] Executado automaticamente por meio do operador new
 * http://php.net/manual/pt_BR/language.oop5.decon.php
 */
fullStackPHPClassSession("__construct", __LINE__);

$user = new \Source\Interpretation\User("Maykon", "Morais", "maykons501@gmail.com");
var_dump($user);

/*
 * [ clone ] Executado automaticamente quando um novo objeto é criado a partir do operador clone.
 * http://php.net/manual/pt_BR/language.oop5.cloning.php
 *
 * Quando faço atribuição entre dois objetos, não estou criando um novo com os mesmos atributos,
 * mas sim, criando uma referência a outro objeto. Portanto, se eu modificar algum deles, a mudança irá
 * surtir nos dois objetos
 *
 */
fullStackPHPClassSession("__clone", __LINE__);

$maykon = $user;

$maria = $maykon;
$maria->setFirstName("Maria");
$maria->setLastName("Cardoso");

$maykon->setFirstName("Maykon");
$maykon->setLastName("Morais");

$maria = clone $maykon;

$mateus = clone $maykon;
$mateus->setFirstName("Mateus");

var_dump($maykon,"<p></p>", $maria, "<p></p>", $mateus);

/*
 * [ destruct ] Executado automaticamente quando o objeto é finalizado
 * http://php.net/manual/pt_BR/language.oop5.decon.php
 */
fullStackPHPClassSession("__destruct", __LINE__);

