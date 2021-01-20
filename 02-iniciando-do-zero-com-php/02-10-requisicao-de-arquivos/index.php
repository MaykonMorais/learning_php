<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("02.10 - Requisição de arquivos");

/*
 * [ include ] https://php.net/manual/pt_BR/function.include.php
 * - Inclui o arquivo mas não que necessariamente seja importante para a aplcação
 * (não geral fatal error)
 * [ include_once ] https://php.net/manual/pt_BR/function.include-once.php
 * (inclui somente uma vez o arquivo)
 */
fullStackPHPClassSession("include, include_once", __LINE__);

//include "file.php";
//echo "<p>Continue</p>";

//require "file.php";
//echo "<p>Continue</p>";

//include "header.php";

include __DIR__."/header.php";

$profile = new stdClass();
$profile->name = "Maykon";
$profile->company = "UFERSA";
$profile->email = "maykons501@gmail.com";
include __DIR__."/profile.php";

$profile = new stdClass();
$profile->name = "Mateus";
$profile->company = "Bee Delivery";
$profile->email = "mtsk10.com";
include __DIR__."/profile.php";


// var_dump($profile);

/*
 * [ require ] https://php.net/manual/pt_BR/function.require.php
 * - O arquivo é realmente necessário para a aplicação
 * [ require_once ] https://php.net/manual/pt_BR/function.require-once.php
 * -
 */
fullStackPHPClassSession("require, require_once", __LINE__);

require __DIR__."/config.php";
echo "<h1>".COURSE."</h1>";

var_dump(require_once __DIR__."/config.php");