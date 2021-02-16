<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.09 - Membros de uma classe");

require __DIR__ . "/source/autoload.php";

use Source\Members\Config;

/*
 * [ constantes ] http://php.net/manual/pt_BR/language.oop5.constants.php
 */
fullStackPHPClassSession("constantes", __LINE__);

$config = new Config();

echo "<p>".$config::COMPANY."</p>";

var_dump(
    Config::COMPANY,
//    Config::DOMAIN,
//    Config::SECTOR
);

// reflexion_class -> recurso para debugar e entender recursos de uma classe
$reflection = new ReflectionClass($config);

var_dump($reflection->getConstants());

/*
 * [ propriedades ] http://php.net/manual/pt_BR/language.oop5.static.php
 * Fazer com o acesso a propriedade seja somente da classe e não do objeto
 */
fullStackPHPClassSession("propriedades", __LINE__);

Config::$company = "UpInside";
Config::$domain = "upinside.com.br";
Config::$sector = "Educação";

$config::$sector = "Tecnologia";

var_dump($reflection->getConstants(),"<p></p>" ,$reflection->getDefaultProperties());
/*
 * [ métodos ] http://php.net/manual/pt_BR/language.oop5.static.php
 */
fullStackPHPClassSession("métodos", __LINE__);

$config::setConfig("", "", "");
$config::setConfig("UpInside", "upinside.com.br","Tecnologia");

var_dump($config, "<p></p>", $reflection->getMethods(), "<p></p>", $reflection->getDefaultProperties());


/*
 * [ exemplo ] Uma classe trigger
 */
fullStackPHPClassSession("exemplo", __LINE__);

use Source\Members\Trigger;

$trigger = new Trigger();
$trigger::show("Um objeto trigger");

$reflection = new ReflectionClass($trigger);

$trigger::show("This a message error", Trigger::ACCEPT);
$trigger::show("This a message error", Trigger::WARNING);
$trigger::show("This a message error", Trigger::ERROR);

//var_dump($reflection->getConstants(), "<p></p>", $reflection->getDefaultProperties());