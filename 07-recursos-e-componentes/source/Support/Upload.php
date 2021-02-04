<?php

namespace Source\Support;

use Source\Core\Message;
use Sirius\Upload\Handler as UploadHandler;

class Upload 
{

  private $message;

  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    $this->message  = new Message();
  }
  
  public function message() : Message
  {
    return $this->message;
  }
  
  /**
   * image
   *
   * @param  string $image
   * @param  string $name
   * @param  int $width
   * @return void
   */
  public function image(array $image, string $name, int $width = CONF_IMAGE_SIZE) : ?string
  {
    $uploadHandler = new UploadHandler(CONF_UPLOAD_DIR."/".CONF_UPLOAD_IMAGE_DIR);

    $uploadHandler->addRule('extension', ['allowed' => 'jpg','jpeg', 'png']);
    $uploadHandler->addRule("imagewidth", "min=100&max={$width}");

    $result = $uploadHandler->process($image);

    if($result->isValid()) {
      try {

        $result->name = $name;
        $result->confirm();
        
        return CONF_UPLOAD_DIR."/".CONF_UPLOAD_IMAGE_DIR."/{$result->name}";

      } catch(\Exception $exception) {
        $result->clear();
        $this->message->error("Error ao importar arquivo!");

        return null;
      }
    }

    $this->message->error("Arquivo não é válido");

    return null;
  }
  
  /**
   * file
   *
   * @param  array $file
   * @param  string $name
   * @return string
   */
  public function file(array $file, string $name) : ?string
  {
    $uploadHandler = new UploadHandler(CONF_UPLOAD_DIR . "/". CONF_UPLOAD_FILE_DIR);

    $uploadHandler->addRule('extension', ['allowed' => 'doc, pdf']);

    $extension = mb_substr($file['name'], strrpos($file['name'], ".") + 1);
    $file['name'] = "{$name}.{$extension}";

    $result = $uploadHandler->process(($file));

    if($result->isValid()) {
      try {
        $result->confirm();

        return CONF_UPLOAD_DIR. "/" . CONF_UPLOAD_FILE_DIR . "/{$result->name}"; 
      } catch(\Exception $exception) {
        $result->clear();

        $this->message->error("Erro ao importar arquivo");
        return null;
      }
    }

    $this->message->error("Arquivo não é válido");
    return null;

  }
  
  /**
   * media
   *
   * @param  array $media
   * @param  string $name
   * @return string
   */
  public function media(array $media, string $name) : ?string
  {
    $uploadHandler = new  UploadHandler(CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_MEDIA_DIR);

    $uploadHandler->addRule('extension', ['allowed' => 'mp4, mp3, mkv']);

    $extension = mb_substr($media['name'], strrpos($media['name'], ".")+  1);
    $media['name'] = "{$name}.{$extension}";

    $result = $uploadHandler->process($media);

    if($result->isValid()) {
      try {
        $result->confirm();


        return CONF_UPLOAD_DIR. "/" . CONF_UPLOAD_MEDIA_DIR . "/{$result->name}"; 

      } catch(\Exception $exception) {
        $result->clear();

        
        $this->message->error("Erro ao importar arquivos!");
        return null;
      }
    }

    $this->message->error("Arquivo não é válido");
    return null;
  }
  
  /**
   * remove
   *
   * @param  string $filePath
   * @return void
   */
  public function remove(string $filePath) : void
  {
    if(file_exists($filePath) && is_file($filePath)) {
      unlink($filePath);
    }
  }

}