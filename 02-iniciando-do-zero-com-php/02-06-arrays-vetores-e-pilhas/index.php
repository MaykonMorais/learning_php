<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("02.06 - Arrays, vetores e pilhas");

/**
 * [ arrays ] https://php.net/manual/pt_BR/language.types.array.php
 */
fullStackPHPClassSession("index array", __LINE__);

$arrA = array(1, 2, 3);
$arrA = [1, 2, 3];

var_dump($arrA);


$arrayIndex = [
    "Brian",
    "Angus",
    "Malcom"
];

$arrayIndex[] = "Cliff";
$arrayIndex[] = "Phil";

var_dump($arrayIndex);

/**
 * [ associative array ] "key" => "value"
 */
fullStackPHPClassSession("associative array", __LINE__);

$acdc = [
    "vocal" => "Brian",
    "solo_guitar" =>  "Angus",
    "bass_guitar" => "Malcom",
    "bass_guitar" => "Cliff",
];

$acdc["drums"] = "Phil";
$acdc["rock_band"] = "AC/DC";

var_dump($acdc);
/**
 * [ multidimensional array ] "key" => ["key" => "value"]
 */
fullStackPHPClassSession("multidimensional array", __LINE__);
$brian = ["Brian", "Mic"];
$angus = ["name" => "Angus", "instrument" => "Guitar"];

$instruments = [
    $brian,
    $angus
];

var_dump($instruments);

echo "<h3></h3>";
var_dump([
    "brian" =>  $brian,
    "angus" => $angus
]);
/**
 * [ array access ] foreach(array as item) || foreach(array as key => value)
 */
fullStackPHPClassSession("array access", __LINE__);
$acdc = [
    "rock_band" =>  "AC/DC",
    "vocal" => "Brian",
    "solo_guitar" =>  "Angus",
    "base_guitar" => "Malcolm",
    "bass_guitar" => "Cliff",
    "drums" =>  "Phil",
];

$pearl =  [
    "rock_band" => "Pearl Jam",
    "vocal" => "Eddie",
    "solo_guitar" => "Mike",
    "base_guitar" => "Stone",
    "bass_guitar" => "Jeff",
    "drums" => "Jack",
];

$rockBands = [
    "acdc" => $acdc,
    "pearl_jam" => $pearl
];

echo
"<p>O Vocal da banda {$acdc["rock_band"]} é {$acdc["vocal"]}  e 
    junto com {$acdc["solo_guitar"]} fazem um ótimo show de rock!
</p>";


echo "<p>{$rockBands['pearl_jam']["vocal"]}</p>";

// exibir valores diretamente
foreach ($acdc as $band) {
    echo "<p>{$band}</p>";
}

// pegando valores e também as chaves em cada iteração
foreach ($acdc as $key => $value) {
    echo "<p>{$value} is a {$key} of band</p>";
}

// percorrendo array multidimensional
foreach ($rockBands  as $rockBand) {
    $article =
    "<article>
        <h1>Nome da Banda: %s</h1>
        <p>%s</p>
        <p>%s</p>
        <p>%s</p>
        <p>%s</p>
        <p>%s</p>
    </article>";

    vprintf($article, $rockBand);
}