<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.10 - Upload de arquivos");

/*
 * [ upload ] sizes | mo ve uploaded | url validation
 * [ upload errors ] http://php.net/manual/pt_BR/features.file-upload.errors.php
 */
fullStackPHPClassSession("upload", __LINE__);

$folder = __DIR__."/uploads";

if(!file_exists($folder) || !is_dir($folder)) {
    mkdir($folder, 0755);
}

var_dump([
    "fileSize" => ini_get("upload_max_filesize"), // pra um arquivo, retorna a quantidade aceita
    "postSize" => ini_get("post_max_size") // pra todos os arquivos + dados retorna a quantidade aceita
]);

var_dump([
    filetype(__DIR__ . "/teste.php"),
    mime_content_type(__DIR__ . "/teste.php")
]);


$getPost = filter_input(INPUT_GET, "post", FILTER_VALIDATE_BOOLEAN);

// validando a existencia de um arquivo e verificando se não está vazio
if($_FILES && !empty($_FILES['file']['name'])) {
    $fileUpload = $_FILES['file'];

    $allowedTypes = ['image/jpg', 'image/jpeg','image/png' ,'application/pdf'];

    $newFileName = time().mb_strstr($fileUpload['name'], '.');
    var_dump($newFileName);

    if(in_array($fileUpload['type'], $allowedTypes)) {
        if(move_uploaded_file($fileUpload['tmp_name'], __DIR__."/uploads/{$newFileName}")) {
            echo "<p  class='trigger accept'> Arquivo enviado com Sucesso! </p>";
        }
        else {
            echo "<p class='trigger error'>Erro inesperado...</p>";
        }
    } else {
        echo "<p class='trigger error'>Tipo de arquivo não permitido!</p>";
    }

} elseif($getPost) { // verificação(post = false), o arquivo é grande e ultrapassa o limite do mime_content_type
    echo "<p class='trigger warning'>Whoops, parece que o arquivo é muito grande</p>";
}
else {
    if($_FILES) {
        echo "<p class='trigger warning'>Selecione um arquivo antes de enviar</p>";
    }

}

include __DIR__."/form.php";
var_dump(scandir(__DIR__."/uploads"));

