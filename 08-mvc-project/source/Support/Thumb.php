<?php

namespace Source\Support;

use CoffeeCode\Cropper\Cropper;

class Thumb
{
  /** @var Cropper */
  private $cropper;

  /** @var string */
  private $uploads;

  public function __construct()
  {
    $this->cropper = new Cropper(CONF_IMAGE_CACHE, CONF_IMAGE_QUALITY['jpg'], CONF_IMAGE_QUALITY['png']);

    $this->uploads = CONF_UPLOAD_DIR;
  }

  /**
   * Upload a image
   * @param  string $image
   * @param  int $width
   * @param  int $height
   * @return string
   */
  public function make(string $image, int $width, int $height =  null): string
  {
    return $this->cropper->make("{$this->uploads}/{$image}", $width, $height);
  }

  /**
   * Remove image from storage
   * @param  string|null $image
   * @return void
   */
  public function flush(string $image =  null): void
  {
    if ($image) {
      $this->cropper->flush("{$this->uploads}/{$image}");
      return;
    }

    $this->cropper->flush();
    return;
  }


  /**
   * cropper
   *
   * @return Cropper
   */
  public function cropper(): Cropper
  {
    return $this->cropper;
  }
}
