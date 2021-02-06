<?php

use Source\Support\Seo;

require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("07.09 - Fornecedor de otimização");

require __DIR__ . "/../vendor/autoload.php";

/*
 * [ optimizer ] https://packagist.org/packages/coffeecode/optimizer
 */
fullStackPHPClassSession("optimizer", __LINE__);

$seo = new Seo();

$seo->render(
  "Formação FullStack PHP Developer",
  "Formação php para desenvolvedores",
  "https://www.upinside.com.br",
  "https://www.upinside.com.br/fsphp/images/cover.jpg"
);

var_dump($seo->optmizer()->data());