<?php

namespace Source\Core;

use League\Plates\Engine;

class View {
  private $engine;
  
  /**
   * __construct
   * @param  string $path
   * @param  string $ext
   * @return void
   */
  public function __construct(string $path = CONF_VIEW_PATH, string $ext = CONF_VIEW_EXT)
  {
    $this->engine = new Engine($path, $ext);
  }

    
  /**
   * path
   * @param  string $name
   * @param  string $path
   * @return View
   */
  public function path(string $name, string $path) : View
  {
    $this->engine->addFolder($name, CONF_VIEW_PATH."/{$path}");
    return $this;
  }
  
  /**
   * render
   * @param  string $templateName
   * @param  array $data
   * @return string
   */
  public function render(string $templateName, array $data) : string
  {
    return $this->engine->render($templateName, $data);
  }
  
  /**
   * engine
   *
   * @return Engine
   */
  public function engine() : Engine
  {
    return $this->engine();
  }
}