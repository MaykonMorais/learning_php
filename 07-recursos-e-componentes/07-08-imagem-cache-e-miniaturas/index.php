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
$thumb = new Thumb();
//var_dump($thumb);
// $thumb->make("maternidade.jpg", 50, 50);


/*
 * [ generate ]
 */
fullStackPHPClassSession("generate", __LINE__);

echo "<img src='{$thumb->make("images/maternidade.jpg", 300)}' alt='' title='' />";
echo "<img src='{$thumb->make("images/maternidade.jpg", 180, 180)}' alt='' title='' />";

$thumb->flush("maternidade.jpg");