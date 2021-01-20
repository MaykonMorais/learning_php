<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.11 - Interação com URLs");

/*
 * [ argumentos ] ?[&[&][&]]
 */
fullStackPHPClassSession("argumentos", __LINE__);

echo "<p><a href='teste.php'>Clear</a></p>";
echo "<p><a href='teste.php?arg=true&arg2=true'>Argumentos</a></p>"; // Parâmetros na URL

$data = [
    "name" => "Maykon",
    "company" => "UFERSA"
];

$object =  (object)$data;

// mandar dados para a URL
$arguments = http_build_query($data); // virar um argumento de url
echo "<p><a href='teste.php?{$arguments}'>Args By Array</a></p>";

/*
 * [ segurança ] get | strip | filters | validation
 * [ filter list ] https://php.net/manual/en/filter.filters.php
 */
fullStackPHPClassSession("segurança", __LINE__);


$dataFilter = [
    "name" => "Maykon",
    "mail" => "mayko501@gmail.com",
    "company" => "UFERSA",
    "site" => "maykonmoras.medium.com",
    "script" => "<script>alert('Esse é um Javascript')</script>"
];

$arguments = http_build_query($dataFilter);

echo "<p><a href='teste.php?{$arguments}'>Data Filter</a></p>";

$dataUrl = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRIPPED);

var_dump($dataUrl);

// tratamentos -> Pós-Filtro
if($dataUrl) {
    if(in_array("", $dataUrl)) {
        echo "<p class='trigger warning'>Faltam dados!</p>";
    } elseif(empty($dataUrl['mail'])) {
        echo "<p class='trigger warning'>Falta o E-mail</p>";
    } elseif(!filter_var($dataUrl['mail'], FILTER_VALIDATE_EMAIL)) {
        echo "<p class='trigger warning'>E-mail inválido</p>";
    }  else {
        echo "<p class='trigger accept'>Tudo certo!</p>";
    }
} else {
    var_dump(false);
}

// Pré-Filtro
$dataFilter = http_build_query(
    [
        "name" => "Maria do Rosário",
        "company" => "UFERSA",
        "mail" => "maria.rosa",
        "site" => "mari",
        "script" => "<script>alert('código malicioso')</script>"
    ]
);

parse_str($dataFilter, $arrDataFilter); //

$dataPreFilter =
    [
        "name" => FILTER_SANITIZE_STRING,
        "company" => FILTER_SANITIZE_STRING,
        "mail" => FILTER_VALIDATE_EMAIL,
        "site" => FILTER_VALIDATE_URL,
        "script" => FILTER_SANITIZE_STRING
    ];

var_dump(filter_var_array($arrDataFilter, $dataPreFilter));