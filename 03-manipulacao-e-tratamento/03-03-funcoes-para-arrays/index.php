<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.03 - Funções para arrays");

/*
 * [ criação ] https://php.net/manual/pt_BR/ref.array.php
 */
fullStackPHPClassSession("manipulação", __LINE__);
$index = [
  "AC/DC",
  "Nirvana",
  "Alter Bridge"
];


$assoc = [
    "band_1" => "AC/DC",
    "band_2" => "Nirvana",
    "band_3" => "Alter Bridge"
];

array_unshift($index, "", "Pearl Jam"); // adicionar um novo índice no começo do array

$assoc = ["band_4" => "Pearl Jam", "band_5" => ""] + $assoc;

// adicionando no final do array
array_push($index, "final");

$assoc = $assoc + ["band_6" => "Ikon"]; // adicionando no final em array associativo

array_shift($index); // remove o primeiro elemento do array
array_shift($index);

array_pop($index); // remove último elemento do array
array_pop($assoc);

array_unshift($index, "");

$index = array_filter($index); // filtro do array (neste caso, ele irá remover qualquer valor vazio)
$assoc = array_filter($assoc);

var_dump([
    $index,
    $assoc
]);

/*
 * [ ordenação ] reverse | asort | ksort | sort
 */
fullStackPHPClassSession("ordenação", __LINE__);

$index = array_reverse($index);
$assoc = array_reverse($assoc);

// ordenar por valor
asort($index);
asort($assoc);

// ordenar pela key
ksort($index);
ksort($assoc);

// inverter ordem das keys
krsort($index);

// ordenar com indices (menor -> maior)
sort($index);
sort($assoc);


// ordenar com indices (maior -> menor)
rsort($index);
rsort($assoc);

var_dump([
    $index,
    $assoc
]);


/*
 * [ verificação ]  keys | values | in | explode
 */
fullStackPHPClassSession("verificação", __LINE__);
$assoc = [
    "band_1" => "AC/DC",
    "band_2" => "Nirvana",
    "band_3" => "Alter Bridge"
];


var_dump(
    [
        array_keys($assoc),
        array_values($assoc)
    ]
);

if(in_array("AC/DC", array_values($assoc))) {
    echo "<p>Achei AC/DC</p>";
}

// transformando um array em uma string: usando implode para separação de cada elemento
$arrToString = implode(", ", array_values($assoc));

echo "<p>Eu curto {$arrToString} e muitas outras...</p>";
echo "<p>{$arrToString}</p>";

//  realizando o inverso, pegando a string e transformando em array (explode)
var_dump(explode(", ", $arrToString));

/**
 * [ exemplo prático ] um template view | implode
 */
fullStackPHPClassSession("exemplo prático", __LINE__);

// definir conjunto de dados
$profile = [
    "name" => "Maykon",
    "company" => "UFERSA",
    "mail" => "maykons501@gmail.com"
];

// definir template
$template = <<<TPL
    <article>
        <h1>{{name}}</h1>
        <p>{{company}}</p><br>
        <a href="mailto:{{mail}}" title="Enviar email para {{name}}">Enviar e-mail</a>
    </article>
TPL;

// transformar o conjunto de dados em string e adicionando separadores
//var_dump(explode("&", $replaces));
$replaces = "{{" . implode("}}&{{", array_keys($profile)) . "}}";
echo str_replace(explode("&", $replaces), array_values($profile), $template);

//echo str_replace(array_keys($profile), array_values($profile), $template);


