<?php

namespace Source\Support;

use CoffeeCode\Optimizer\Optimizer;

class Seo 
{
  /** @var Optimizer */
  protected $optmizer;

  public function __construct(string $schema = "article")
  {
    $this->optmizer = new Optimizer();

    $this->optmizer->openGraph(
      CONF_SITE_NAME,
      CONF_SITE_LANG,
      $schema
    );
  }

  public function __get($name) 
  {
    $this->optmizer->meta()->$name;
  }

  public function render(string $title, string $description, string $url, string $image, bool $follow = true) 
  {
    return $this->optmizer($title, $description, $url, $image, $follow)->render();
  }

  
  /**
   * optimizer
   * @return Optimizer
   */
  public function optmizer() : Optimizer
  {
    return $this->optmizer;
  }
}