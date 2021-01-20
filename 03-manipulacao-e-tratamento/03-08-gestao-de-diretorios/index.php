<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.08 - Gestão de diretórios");

/*
 * [ verificar, criar e abrir ] file_exists | is_dir | mkdir  | scandir
 */
fullStackPHPClassSession("verificar, criar e abrir", __LINE__);

$folder = __DIR__."/uploads";
//mkdir($folder, 0755); // criar diretório

if(!file_exists($folder) || !is_dir($folder)) {
    mkdir($folder,  0755);
} else {
    var_dump(scandir($folder));
}

/*
 * [ copiar e renomear ] copy | rename
 */
fullStackPHPClassSession("copiar e renomear", __LINE__);

$file =  __DIR__."/file.txt";
//mkdir(__DIR__."/tmp", 0755);

var_dump(
    pathinfo($file),
    scandir($folder),
    scandir(__DIR__)
);


if(!file_exists($file) || !is_file($file)) {
    fopen($file, "w");
} else {
    copy($file, $folder . "/" .  basename($file));
    rename(__DIR__."/uploads/file.txt", __DIR__."/uploads/".time().".".pathinfo($file)['extension']);

    rename($file, __DIR__."/uploads/".time().".".pathinfo($file)['extension']);
}

/*
 * [ remover e deletar ] unlink | rmdir
 */
fullStackPHPClassSession("remover e deletar", __LINE__);

//mkdir("remove", 0755);
//rmdir(__DIR__."/remove"); // remove os arquivos se o diretório estiver vazio

// caso nao, devemos percorrer os arquivos e ir-los removendo um por um

$dirRemove = __DIR__."/uploads";
$dirFiles = array_diff(scandir($dirRemove), ['.', '..']);
$dirCount = count($dirFiles);

if($dirCount >= 1) {
    echo "<h2>Clear...</h2>";

    foreach(scandir($dirRemove) as $fileItem) {
        $fileItem = __DIR__."/uploads/{$fileItem}";
        if(file_exists($fileItem) && is_file($fileItem))  {
           unlink($fileItem);
        }
    }
} else {

}

//var_dump($dirFiles);
