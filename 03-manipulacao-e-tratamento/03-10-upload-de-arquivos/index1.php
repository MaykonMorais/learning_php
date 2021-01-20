<?php
require __DIR__.'/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.10 - Upload de Arquivos");

/*
 * [ upload ] size | move_uploaded | url_validation
 *
 * */

fullStackPHPClassSession("upload", __LINE__);

$folder = __DIR__."/uploads";

if(!file_exists($folder) || !is_dir($folder)) {
    mkdir($folder, 0755);
}


var_dump([
    "fileSize" => ini_get("upload_max_filesize"),
    "postSize" => ini_get("post_max_size")
]);

$getPost = filter_input(INPUT_POST, "post", FILTER_VALIDATE_BOOLEAN);

echo $getPost;

if($_FILES && !empty($_FILES['file']['name'])) {
    $fileUpload = $_FILES['file'];

    $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'application/pdf'];

    $newFileName  = time().mb_strstr($fileUpload['name'], '.');

    if(in_array($fileUpload['type'], $allowedTypes)) {
        if(move_uploaded_file($fileUpload['tmp_name'], __DIR__."/uploads/{$newFileName}")) {
            echo "<p class='trigger accept'>Arquivo enviado com sucesso!</p>";
        }
        else {
            echo "<p class='trigger error'>Erro inesperado...</p>";
        }
    }

    else {
        echo "<p class='trigger  warning'>Tipo de arquivo não aceito</p>";
    }
} elseif($getPost) {
    echo "<p class='trigger warning'>Whoops, pare que o arquivo é muito grande</p>";
} else {
    if($_FILES) {
        echo "<p class='trigger warning'>Selecione um arquivo antes de enviar!</p>";
    }

}


include __DIR__."/form.php";