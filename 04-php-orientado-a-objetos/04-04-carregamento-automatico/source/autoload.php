<?php

spl_autoload_register(function ($class) {
   $prefix = "Source\\";
   $baseDir = __DIR__."/";

   var_dump($class);
   $len = strlen($prefix);
   //var_dump(strcmp($prefix, $class, $len)); // comparação entre o prefixo da classe do callback e namespace

    if(strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relativeClass = substr($class, $len);
    $file = $baseDir.str_replace("\\", "/", $relativeClass).".php";

    if(file_exists($file)) {
        require $file;
    }
});