<?php

use Source\Core\Email;

require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("07.05 - Sintetizando e abstraindo");

require __DIR__ . "/../vendor/autoload.php";

/*
 * [ synthesize ]
 */
fullStackPHPClassSession("synthesize", __LINE__);

$email = (new Email())->bootstrap(
  "Test message",
  "<h1>Hey</h1><p>You're awesome!</p>",
  "maykons501@gmail.com",
  "Maykon Morais",
);

$email->attach(__DIR__."/../source/Core/Message.php",  "Class Message");
$email->attach(__DIR__."/../source/Core/Model.php",  "Class Model");


//var_dump($email);

if($email->send())
{
  echo message()->success("Mensagem enviada com sucesso!");
}
else {
  echo $email->message();
}