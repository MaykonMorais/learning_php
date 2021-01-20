<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("02.12 - Constantes e constantes mágicas");

/*
 * [ constantes ] https://php.net/manual/pt_BR/language.constants.php
 */
fullStackPHPClassSession("constantes", __LINE__);

define("COURSE", "Full Stack PHP"); // runtime
const AUTHOR = "Robson"; // compile time

$formation = true;
if($formation) {
    define("COURSE_TYPE", "Formação");
}
else {
    define("COURSE_TYPE", "Curso");
}

echo "<p>".COURSE."</p>";

// usar constantes em classes (lugar mais recomendado para uso de constantes)
class OnClass {
    const USER = "root";
    const HOST =  "localhost";
};

echo "<p>", OnClass::HOST, "</p>";
echo "<p>", OnClass::USER, "</p>";


/*
 * [ constantes mágicas ] https://php.net/manual/pt_BR/language.constants.predefined.php
 */
fullStackPHPClassSession("constantes mágicas", __LINE__);

var_dump([
    __LINE__,
    __FILE__,
    __DIR__
]);

function fullStackPHP() {
    return __FUNCTION__;
}

var_dump(fullStackPHP());

trait MyTrait {
    public $traitName = __TRAIT__;
}

class FsPHP {
    use MyTrait;
    public $className = __CLASS__;
}

var_dump(new FsPHP());

echo "<h3></h3>";
require __DIR__."/MyClass.php";
var_dump(new \Source\MyClass());