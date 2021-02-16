<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.03 - Qualificação e encapsulamento");

/*
 * [ namespaces ] http://php.net/manual/pt_BR/language.namespaces.basics.php
 * Acesso único à uma classe tendo controle total da aplicação
 */
fullStackPHPClassSession("namespaces", __LINE__);

require __DIR__."/classes/App/Template.php";
require __DIR__."/classes/Web/Template.php";

$appTemplate = new App\Template();
$webTemplate = new  Web\Template();

//var_dump($appTemplate, $webTemplate);


use App\Template;
use Web\Template AS WebTemplate;

$appUseTemplate = new Template();
$webUseTemplate = new WebTemplate();

var_dump($appUseTemplate, $webUseTemplate);

/*
 * [ visibilidade ] http://php.net/manual/pt_BR/language.oop5.visibility.php
 * Garantir que métodos tenham responsabilidades claras sobre a nossa aplicação
 */
fullStackPHPClassSession("visibilidade", __LINE__);

require __DIR__."/source/Qualifield/User.php";

use \Source\Qualifield\User;

$user = new User("Maykon", "Morais", "maykons501@gmail.com");

// As propriedades da classe são privadas
//$user->firstName = "Maykon";
//$user->lastName = "Morais";
//$user->email  =  "maykons501@gmail.com";

// métodos agora são privados
//$user->setFirstName("Maykon");
//$user->setLastName("Morais");
//$user->setEmail("maykon.estudos@gmail.com");


var_dump($user);


/*
 * [ manipulação ] Classes com estruturas que abstraem a rotina de manipulação de objetos
 */
fullStackPHPClassSession("manipulação", __LINE__);
