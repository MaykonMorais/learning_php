<?php

namespace Source\App\Controllers;

use CoffeeCode\Paginator\Paginator;
use Source\Core\Connect;
use Source\Core\Controller;
use Source\Core\Message;
use Source\Core\View;
use Source\Models\User;

class UserController extends Controller
{
  private $template;
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    $this->template = new View();

    $this->template->path("test", "test");
  }
  
  /**
   * home
   *
   * @return void
   */
  public function home() 
  {
    $getPage = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);

    $total = Connect::getInstance()->query("SELECT count(id) as total FROM users")->fetch()->total;
    $pager = new Paginator("?page=");
    $pager->pager($total, 3, $getPage, 2);

    echo $this->template->render("test::list", [
      "title" => "Usuários do sistema",
      "list" => (new User())->all($pager->limit(), $pager->offset()),
      "pager" => $pager->render()
    ]);
  }
  
  /**
   * edit
   *
   * @return void
   */
  public function edit()
  {
     $getUser = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

     $user = ($getUser ? ((new User())->findById($getUser)) : null);
    
     if(!$user) {
       (new Message())->error("Usuário não encontrado")->flash(); 

       header("Location: ./");
       exit;
     }

     echo $this->template->render("test::user", [
      "user" => $user
     ]);
  }
}