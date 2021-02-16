<?php

namespace Source\Support;

use CoffeeCode\Paginator\Paginator;

class Pager extends Paginator
{
  public function __construct(string $link, ?string $title = null, ?array $first = null, ?array $last = null)
  {
    parent::__construct($link, $title, $first, $last);
  }
}
