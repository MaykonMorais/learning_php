<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("03.07 - Manipulação de arquivos");

/*
 * [ verificação de arquivos ] file_exists | is_file | is_dir
 */
fullStackPHPClassSession("verificação", __LINE__);

$file = __DIR__."/file.txt";

//  file_exists -> verifica se arquivo existe
// is_file -> Verifica se de fato é um arquivo ou um diretório
if(file_exists($file) && is_file($file)) {
    echo "<p>Existe!</p>";
} else {
    echo "<p>Não existe!</p>";
}

/*
 * [ leitura e gravação ] fopen | fwrite | fclose | file
 */
fullStackPHPClassSession("leitura e gravação", __LINE__);

// file -> Ler o arquivo
if(!file_exists($file) || !is_file($file)) {
    $fileOpen = fopen($file, "w");

    fwrite($fileOpen, "Linha 01".PHP_EOL);
    fwrite($fileOpen, "Linha 02".PHP_EOL);
    fwrite($fileOpen, "Linha 03".PHP_EOL);
    fwrite($fileOpen, "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu metus neque. Quisque tempus vehicula diam, at aliquet mi interdum a. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed metus tellus, molestie vitae lorem at, faucibus convallis odio. Maecenas at mattis ex, a placerat leo. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut ultricies lorem tortor, vitae euismod nunc vehicula vitae. Etiam convallis erat eget consequat ultricies. Proin mi elit, interdum quis velit at, sollicitudin porta felis. Nullam ut libero eget felis accumsan viverra. Ut efficitur, tellus eget congue accumsan, turpis ipsum laoreet tellus, eu luctus tortor arcu non massa. Ut in consectetur purus. Quisque blandit mi a odio molestie varius. Curabitur fermentum et mi ac laoreet.".PHP_EOL);


    fclose($fileOpen);

} else {
    var_dump(file($file), pathinfo($file));
}

echo "<p>".file($file)[3]."</p>";

// percorrer as linhas do arquivo

$open = fopen($file, "r");

while(!feof($open)) {
    echo "<p>".fgets($open)."</p>";
}

fclose($open);

/*
 * [ get, put content ] file_get_contents | file_put_contents
 * Forma de obter e adicionar dados em um arquivo
 */
fullStackPHPClassSession("get, put content", __LINE__);

$getContents =  __DIR__."/teste2.txt";

//file_get_contents($getContents); // só trabalha com arquivos já criados

if(file_exists($getContents) && is_file($getContents))  {
    echo file_get_contents($getContents);
}
else {
    $data =  "<article><h1>Maykon Morais</h1><p>Student of Computer Science</p></article>";
    file_put_contents($getContents, $data); // adicionando novo conteudo para o arquivo

    echo file_get_contents($getContents);
}

//unlink($getContents);
//unlink($file);

// rotina para deletar arquivo
if(file_exists(__DIR__."/teste.txt") && is_file(__DIR__."/teste.txt")) {
    unlink(__DIR__."/teste.txt");
}

