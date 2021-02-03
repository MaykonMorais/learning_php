<?php

use Source\Core\View;
use Source\Models\User;

require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("07.06 - Uma camada de visualização");

require __DIR__ . "/../vendor/autoload.php";

/*
 * [ plates ] https://packagist.org/packages/league/plates
 */
fullStackPHPClassSession("plates", __LINE__);

//$plates = \League\Plates\Engine();

//$plates = new \League\Plates\Engine(__DIR__."/../source/assets/views/test");

//var_dump(get_class_methods($plates));

//$plates->addFolder("test", "test");

// if(empty($_GET["id"])) {
//   echo $plates->render("list", [
//     "title" => "Usuários do Sistema",
//     "list"  =>  (new User)->all()
//   ]);

// } else {
  
//   echo $plates->render("user", [
//     "title" => "Editar Usuário",
//     "user" => (new User())->findById($_GET["id"])
//   ]);
// }


/*
  [ synthesize ] Sintetizando rotina e abstraíndo o recurso (componente) 
*/
fullStackPHPClassSession("synthesize", __LINE__);

echo is_dir("/opt/lampp/htdocs/fsphp/07-recursos-e-componentes/source/Support/../assets/views/");
echo is_null("/opt/lampp/htdocs/fsphp/07-recursos-e-componentes/source/Support/../assets/views/");

$view = new View();
$view->path("test", "test");

if(empty($_GET["id"])) {
  echo $view->render("test::list", [
    "title" => "Usuários do Sistema",
    "list"  =>  (new User)->all()
  ]);

} else {
  
  echo $view->render("test::user", [
    "title" => "Editar Usuário",
    "user" => (new User())->findById($_GET["id"])
  ]);
}
