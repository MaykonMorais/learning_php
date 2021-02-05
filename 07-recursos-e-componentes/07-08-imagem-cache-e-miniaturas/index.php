<?php

use Source\Support\Thumb;

require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("07.08 - Imagem, cache e miniaturas");

require __DIR__ . "/../vendor/autoload.php";

/*
 * [ cropper ] https://packagist.org/packages/coffeecode/cropper
 */
fullStackPHPClassSession("cropper", __LINE__);

//echo phpinfo();
$cropper = new Thumb();

$cropper->make("maternidade.jpg", 50, 50);


/*
 * [ generate ]
 */
fullStackPHPClassSession("generate", __LINE__);