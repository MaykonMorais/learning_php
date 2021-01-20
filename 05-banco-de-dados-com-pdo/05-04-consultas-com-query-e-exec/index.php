<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("05.04 - Consultas com query e exec");

require __DIR__ . "/../source/autoload.php";

use Source\Database\Connect;

/*
 * [ insert ] Cadastrar dados.
 * https://mariadb.com/kb/en/library/insert/
 *
 * [ PDO exec ] http://php.net/manual/pt_BR/pdo.exec.php
 *  Executa o comando e não retorna nada além de 0 (deu errado) e 1(deu certo)
 * [ PDO query ]http://php.net/manual/pt_BR/pdo.query.php
 * - Executa a consulta ao banco e também retorna possíveis dados
 */
fullStackPHPClassSession("insert", __LINE__);

$insert =
    "INSERT INTO users (first_name, last_name, email, document)
     VALUES ('Maykon', 'Morais', 'maykons501@gmail.com', '2883771')
";

try {
    //$exec = Connect::getInstace()->exec($insert);

    $exec = null;

    $query = Connect::getInstace()->query($insert);

    var_dump(
        Connect::getInstace()->lastInsertId(),
        $query->errorInfo(),
    );
} catch (PDOException $exception) {
    echo "<p class='trigger error'>{$exception->getMessage()}</p>";
}

/*
 * [ select ] Ler/Consultar dados.
 * https://mariadb.com/kb/en/library/select/
 */
fullStackPHPClassSession("select", __LINE__);

try {
    $query = Connect::getInstace()->query('SELECT  *  FROM users LIMIT 2');

    var_dump([
        $query,
        $query->rowCount(),
        $query->fetchAll(),
    ]);
} catch (PDOException $exception) {
   echo "<p class='trigger error'>{$exception->getMessage()}</p>";
}


/*
 * [ update ] Atualizar dados.
 * https://mariadb.com/kb/en/library/update/
 */
fullStackPHPClassSession("update", __LINE__);


try {
    $exec = Connect::getInstace()->exec("UPDATE users SET first_name = 'Maria' WHERE first_name = 'Maykon'");

    var_dump([
        $exec
    ]);

} catch (PDOException $exception) {
    echo "<p class='trigger error'>{$exception->getMessage()}</p>";
}

/*
 * [ delete ] Deletar dados.
 * https://mariadb.com/kb/en/library/delete/
 */
fullStackPHPClassSession("delete", __LINE__);

try {
    $exec = Connect::getInstace()->exec('DELETE FROM users where id > 50 ');

    var_dump([
        $exec
    ]);
} catch (PDOException $exception) {
    echo "<p class='trigger error'>{$exception->getMessage()}</p>";
}