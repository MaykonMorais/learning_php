<?php
require('../../fullstackphp/fsphp.php');

fullStackPHPClassName("03.11 - Interação com URLs");

fullStackPHPClassSession("Argumentos", __LINE__);

echo "<p><a href='revision.php'>Clear</a></p>";
echo "<p><a href='revision.php?arg=true&arg2=true'>Argumentos</a></p>";

$data = [
    "name" => "Maykon",
    "company" => "UFERSA"
];

$object = (object)$data;

// construir query para mandar na requisição
$arguments = http_build_query($data);
echo "<p><a href='revision.php?{$arguments}'>Url With Args</a></p>";

/*
 * [ segurança ] get | strip | filters | validation
 * */

fullStackPHPClassSession("Segurança", __LINE__);

$dataFilter = [
    "name" => "Maykon",
    "mail" => "maykons50",
    "company" => "UFERSA",
    "site" =>  "maykon.medium.com.br",
    "script" => "<script>alert('script malicioso')</script>"
];

$arguments = http_build_query($dataFilter);

$dataUrl = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRIPPED);

echo "<p><a href='revision.php?{$arguments}'>DataFilter</a></p>";

if($dataUrl) {
    if(in_array("", $dataUrl)) {
        echo "<p class='trigger warning'>Faltam dados</p>";
    }
    elseif(empty($dataUrl['mail'])) {
        echo "<p class='trigger warning'>Email vazio</p>";
    }
    elseif(!filter_var($dataUrl['mail'], FILTER_VALIDATE_EMAIL)) {
        echo "<p class='trigger warning'>E-mail inválido</p>";
    } else {
        echo "<p class='trigger accept'>Tudo certo</p>";
    }
} else {
    var_dump(false);
}

// Pré-Filtro

// conjunto de dados
$dataFilter = http_build_query(
    [
        "name" => "Marina de Sousa",
        "company" => "UFERSA",
        "mail" => "marina@gmail.com",
        "site" => "marina.medium.com",
        "script" => "<script>alert('malicious code')</script>"
    ]);


parse_str($dataFilter, $arrDataFilter);

// filtros
$dataPreFilter =
    [
        "name" => FILTER_SANITIZE_STRING,
        "company" => FILTER_SANITIZE_STRING,
        "mail" => FILTER_VALIDATE_EMAIL,
        "site" => FILTER_VALIDATE_URL,
        "script" =>  FILTER_SANITIZE_STRING
    ];

var_dump(filter_var_array($arrDataFilter, $dataPreFilter));
