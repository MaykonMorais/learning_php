<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("07.07 - Uma fachada para arquivos");

require __DIR__ . "/../vendor/autoload.php";

/*
 * [ image ] Fachada para envio de imagens (jpg, png, gif)
 */
fullStackPHPClassSession("image", __LINE__);

use Source\Support\Upload;

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

$upload = new Upload();

if($post && $post['send'] == 'image') {
 // var_dump($post, ($_FILES ?? ""));

 /** @var \Sirius\Upload\Result\File $u */
  $u = $upload->image($_FILES['file'], $post['name']);

  if($u) {
      echo "<img src='{$u}' style='width: 100%' />";

  } else {
    echo $upload->message();
  }
}

$formSend = "image";
require __DIR__ . "/form.php";


/*
 * [ file ] Fachada para envio de arquivos (pdf, docx, zip, etc)
 */
fullStackPHPClassSession("file", __LINE__);


$formSend = "file";
require __DIR__ . "/form.php";


$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

if($post && $post['send'] == 'file') {

  $u = $upload->file($_FILES['file'], $post['name']);

  if($u) {
    echo "<a class='trigger info' target='_blank' href='{$u}'>Acesse aqui o arquivo</a>";
  } else {
    echo $upload->message();
  }
}

/*
 * [ media ] Fachada para envio de midias (audio/video)
 */
fullStackPHPClassSession("media", __LINE__);


$formSend = "media";
require __DIR__ . "/form.php";

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

if($post && $post['send'] == 'media') {

  $u = $upload->media($_FILES['file'], $post['name']);

  if($u) {
    echo "<p class='trigger info'><a target='_blank' href='{$u}'>Ver arquivo</a></p>";
  }

  else {
    echo $upload->message();
  }
}

/*
 * [ remove ] Um método adicional
 */
fullStackPHPClassSession("remove", __LINE__);


$upload->remove(__DIR__."/../storage/uploads/medias/opa.04_Atualizando_interpretador.mp4");