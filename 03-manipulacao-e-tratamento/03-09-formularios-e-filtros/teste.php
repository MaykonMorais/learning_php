<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.09 - Formuários e filtros");

/*
 * [ request ] $_REQUEST
 * https://php.net/manual/pt_BR/book.filter.php
 */
fullStackPHPClassSession("request", __LINE__);

$form = new stdClass();
$form->name = "Maykon";
$form->mail = "teste@gmail.com";

var_dump($_REQUEST); // monitora todos os métodos da aplicação

$form->method = "post";
include __DIR__."/form.php";

/*
 * [ post ] $_POST | INPUT_POST | filter_input | filter_var
 */
fullStackPHPClassSession("post", __LINE__);

//var_dump($_POST);

$post = filter_input(INPUT_POST, "name", FILTER_DEFAULT); // pega somente um parametro
$postArray = filter_input_array(INPUT_POST, FILTER_DEFAULT); // pega o array de parametros

 //var_dump([
//    $post,
//    $postArray
//]);

if($postArray) {
    if(in_array("", $postArray)) { // verificando se há algum campo vazio
        echo "<p class='trigger warning'>Preencha todos os campos</p>";
    } else if(!filter_var($postArray['mail'], FILTER_VALIDATE_EMAIL)) {
        echo "<p class='trigger warning'>E-mail informado não é válido</p>";
    } else {
        $saveStrip = array_map("strip_tags", $postArray); // iterar sobre o array, (strip_tags) remove códigos de cada tag
        $save = array_map("trim", $saveStrip); // remove espaços desnecessários da string

        var_dump($save);

        echo "<p class='trigger accept'>Cadastro com Sucesso</p>";
    }
}

$form->method = "post";
include __DIR__."/form.php";

/*
 * [ get ] $_GET | INPUT_GET | filter_input | filter_var
 */
fullStackPHPClassSession("get", __LINE__);

$form->method = "get";
//var_dump($_GET);

$get = filter_input(INPUT_GET, "mail", FILTER_DEFAULT);
$getArray = filter_input_array(INPUT_GET, FILTER_DEFAULT);

var_dump($getArray);

include  __DIR__."/form.php";

/*
 * [ filters ] list | id | var[_array] | input[_array]
 * http://php.net/manual/pt_BR/filter.constants.php
 */
fullStackPHPClassSession("filters", __LINE__);

//var_dump(
//    filter_list(),
//    [
//        filter_id("validate_email")
//    ]
//);

// usado para quando tivermos vários parâmetros
$filterForm =[
    "name" =>  FILTER_SANITIZE_STRIPPED,
    "mail" => FILTER_VALIDATE_EMAIL
];

// filter_input_... => usando quando recebo o formulário (validação)
$getForm = filter_input_array(INPUT_GET, $filterForm);

var_dump($getForm);

// filter_var =>  usado quando já recebemos os valores

$email = "maykons501@gmail";

var_dump(
    [
    filter_var($email, FILTER_VALIDATE_EMAIL)
    ],
    filter_var_array($getForm, $filterForm)
);