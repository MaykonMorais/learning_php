<?php

namespace Source\Core;

class Route 
{
  protected static $route;
    
  /**
   * get
   *
   * @param  string $route
   * @param  mixed $handler
   * @return void
   */
  public static function get(string $route, $handler) : void
  {
    $get = "/". filter_input(INPUT_GET, "url", FILTER_SANITIZE_SPECIAL_CHARS);
    
    self::$route = [
      $route => [
        "route" => $route, // Controller:method
        "controller" => (!is_string($handler) ? $handler: strstr($handler, ":", true) ),
        "method" => (!is_string($handler)) ?: str_replace(":", "", strstr($handler, ":", false))
      ]
    ];

    self::dispatch($get);
  } 
  
  /**
   * Disparar o método do Controller ou executar Closure
   *
   * @param  mixed $route
   * @return void
   */
  public static function dispatch($route) : void
  {
    $route = (self::$route[$route] ?? []);

    if($route) {
      if($route['controller'] instanceof \Closure) {
        call_user_func($route['controller']);
        return;
      } 

      $controller = self::namespace(). $route['controller'];
      $method = $route['method'];

      if(class_exists($controller)) 
      {
        $newController = new $controller;

        if(method_exists($controller, $method)) {
          $newController->$method();
        }
      }
    }
  }
  
  /**
   * route
   * @return Route
   */
  public static function route() : array
  {
    return self::$route;
  }
  
  /**
   * namespace
   *
   * @return string
   */
  private static function namespace() : string
  {
    return "Source\App\Controllers\\";
  }
}