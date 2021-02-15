<?php

namespace Source\Core;

use League\Plates\Engine;

class View
{
  private $engine;

  public function  __construct(string $path = CONF_VIEW_PATH, string $ext = CONF_VIEW_EXT)
  {
    $this->engine = new Engine($path, $ext);
  }

  public function path(string $name, string $path): View
  {
    $this->engine->addFolder($name, CONF_VIEW_PATH . "/{$path}");
    return $this;
  }

  public function render(string $templateName, array $data): string
  {
    return $this->engine->render($templateName, $data);
  }

  public function engine(): Engine
  {
    return $this->engine();
  }
}
