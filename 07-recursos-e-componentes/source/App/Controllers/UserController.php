<?php

namespace Source\App\Controllers;

use Source\Core\Connect;
use Source\Core\Controller;
use Source\Core\View;

class UserController extends Controller
{
  private $template;

  public function __construct()
  {
    $this->template = new View();

    $this->template->path("test", "test");
  }

  public function home() 
  {
    $getPage = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);

    $total = Connect::getInstance()->query("select count(id) as total FROM users")->fetch()->total;
  }

  public function edit()
  {
     
  }
}