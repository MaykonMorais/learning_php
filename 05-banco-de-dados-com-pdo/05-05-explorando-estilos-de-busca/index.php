<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("05.05 - Explorando estilos de busca");

require __DIR__ . "/../source/autoload.php";

use Source\Database\Connect;

/*
 * [ fetch ] http://php.net/manual/pt_BR/pdostatement.fetch.php
 */
fullStackPHPClassSession("fetch", __LINE__);

try {
    $connect = Connect::getInstace();
    $read = $connect->query('SELECT * FROM users LIMIT 3');

    if(!$read->rowCount()) {
        echo "<p class='trigger warning'>Não obteve resultados</p>";
    } else {
        //var_dump($read->fetch(PDO::FETCH_OBJ));

        while($user = $read->fetch()) {
            echo "<p class='trigger accept'>{$user->first_name}</p>";
        }

    }

} catch (PDOException $exception) {
    echo "<p class='trigger error'>{$exception->getMessage()}</p>";
}

/*
 * [ fetch all ] http://php.net/manual/pt_BR/pdostatement.fetchall.php
 * Trazer um array com todos os resultados
 */
fullStackPHPClassSession("fetch all", __LINE__);

$connect = NULL;
try {
    $connect = Connect::getInstace();

    $read = $connect->query('SELECT * FROM users LIMIT 3,2');

//    while($user = $read->fetchAll()) {
//        var_dump($user);
//    }
    foreach ($read->fetchAll() as $user) {
        echo "<p class='trigger accept'>{$user->first_name}</p>";
    }


} catch(PDOException $exception) {
    echo "<p class='trigger error'>{$exception->getMessage()}</p>";
}


/*
 * [ fetch save ] Realizar um fetch diretamente em um PDOStatement resulta em um clear no buffer da consulta. Você
 * pode armazenar esse resultado em uma variável para manipilar e exibir posteriormente.
 */
fullStackPHPClassSession("fetch save", __LINE__);

$connect = NULL;
try {
    $connect = Connect::getInstace();

    $read = $connect->query('SELECT  * FROM users LIMIT 5,1');
    $result = $read->fetchAll();

    var_dump(
        $read->fetchAll(),
        $result
    );


} catch (PDOException $exception) {
    echo "<p class='trigger error'>{$exception->getMessage()}</p>";
}


/*
 * [ fetch modes ] http://php.net/manual/pt_BR/pdostatement.fetch.php
 */
fullStackPHPClassSession("fetch styles", __LINE__);

$connect = NULL;

try {
    $connect = Connect::getInstace();

    $read = $connect->query('SELECT * FROM users LIMIT 1');

    foreach ($read->fetchAll() as $user) { // FETCH_OBJ
        echo "<p class='trigger accept'>{$user->first_name}</p>";
    }

    $read = $connect->query('SELECT * FROM users LIMIT 1');
    foreach ($read->fetchAll(PDO::FETCH_NUM) as $user) { // FETCH NUMÉRICO -> CADA propriedade tem indice
        echo "<p class='trigger accept'>{$user[2]}</p>";
    }

    $read = $connect->query('SELECT * FROM users LIMIT 1');
    foreach ($read->fetchAll(PDO::FETCH_ASSOC) as $user) { // FETCH ASSOC
        echo "<p class='trigger accept'>{$user['first_name']}</p>";
    }

    $read = $connect->query('SELECT * FROM users LIMIT 1');
    foreach ($read->fetchAll(PDO::FETCH_CLASS, \Source\Database\Entity\UserEntity::class) as $user) { // FETCH ASSOC
        /**  @var \Source\Database\Entity\UserEntity $user */
        var_dump(
            $user,
            $user->getFirstName()
        );
        //echo "<p class='trigger accept'>{$user->}</p>";
    }



} catch (PDOException $exception) {
    echo "<p class='trigger error'>{$exception->getMessage()}</p>";
}

