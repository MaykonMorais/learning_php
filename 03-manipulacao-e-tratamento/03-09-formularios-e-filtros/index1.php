<?php
require __DIR__.'/../../fullstackphp/fsphp.php';

fullStackPHPClassName('03.09  - Formulários e Filtros');


/*
 * [ request ] $_REQUEST
 * */

fullStackPHPClassSession("request", __LINE__);

$form = new stdClass();
$form->name = "Raquel";
$form->mail = "test@test.com";

var_dump($_REQUEST);

$form->method = "post";

/*
 * [ post ] $_POST | $INPUT_POST | filter_input | filter_var
 * */

fullStackPHPClassSession("post", __LINE__);

$post = filter_input(INPUT_POST, "name", FILTER_DEFAULT);
$postArray = filter_input_array(INPUT_POST, FILTER_DEFAULT);

include __DIR__."/form.php";

//var_dump($postArray);

// validação do post
if($postArray) {
    if(in_array("", $postArray)) {
        echo "<p class='trigger warning'>Preencha todos os campos!</p>";
    } elseif(!filter_var($postArray['mail'], FILTER_VALIDATE_EMAIL)) {
        echo "<p class='trigger warning'>E-mail informado não é válido</p>";
    } else {
        $saveStrip = array_map("strip_tags", $postArray); // itera sobre o array e retira código da linguagem
        $save = array_map("trim", $saveStrip); // remove espaços em branco no início e final de cada elemento

        echo "<p class='trigger accept'>Cadastro realizado com Sucesso!</p>";
    }
}

/*
 * [ get ] $_GET | INPUT_GET | filter_input | filter_var
 * */
fullStackPHPClassSession("get", __LINE__);

$form->method = "get"; // $_GET -> monitora a ação get
include __DIR__."/form.php";

$get = filter_input(INPUT_GET, "name", FILTER_DEFAULT);
$getArray = filter_input_array(INPUT_GET, FILTER_DEFAULT);

echo "<p>{$get}</p>";

fullStackPHPClassSession("filters", __LINE__);

$email = "maykons501@gmail.com";
include __DIR__."/form.php";

$filterForm = [
    "name" => FILTER_SANITIZE_STRIPPED,
    "mail" => FILTER_SANITIZE_EMAIL
];

$getForm = filter_input_array(INPUT_GET, $filterForm);

var_dump($getForm);

