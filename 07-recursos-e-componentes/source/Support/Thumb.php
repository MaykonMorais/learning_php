<?php

namespace Source\Support;

use Imagine\Image\Box;
use Imagine\Imagick\Imagine;

class Thumb {
  /** @var Imagine */
  private $cropper;
  private $uploads;

  public function __construct()
  {
    $this->cropper = new Imagine();

    $this->uploads = CONF_IMAGE_CACHE;

  }

  public function make(string $image, int $width, int $height)
  {
    $img = $this->cropper->open($image);
    $img->resize(new Box($width, $height));

    $img->save("{$this->uploads}/{$image}", CONF_CACHE_OPTIONS);

    return $img;
  }
}