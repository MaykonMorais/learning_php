<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("05.07 - PDOStatement e bind modes");

// irá nos permitir impedir ataques de SqlInjection

require __DIR__ . "/../source/autoload.php";

use Source\Database\Connect;

/**
 * [ prepare ] http://php.net/manual/pt_BR/pdo.prepare.php
 */
fullStackPHPClassSession("prepared statement", __LINE__);

$stmt = Connect::getInstace()->prepare("SELECT * FROM users LIMIT 1");
$stmt->execute();

var_dump([
        "Linhas" => $stmt->rowCount(),
        "Colunas" => $stmt->columnCount(),
        "fetch" => $stmt->fetch()
    ]
);
/*
 * [ bind value ] http://php.net/manual/pt_BR/pdostatement.bindvalue.php
 *
 */
fullStackPHPClassSession("stmt bind value", __LINE__);

$stmt = NULL;
//$stmt = Connect::getInstace()->prepare("SELECT * FROM users WHERE id = :id");
//$stmt->bindValue(":id", 50, PDO::PARAM_INT); // tratamento do valor por meio do bind
//$stmt->execute();
//
//var_dump($stmt->fetch());

//$stmt = Connect::getInstace()->prepare("
//    INSERT INTO users (first_name, last_name) VALUES (?, ?)
//");
//$stmt->bindValue(1, "Gustavo", PDO::PARAM_STR);
//$stmt->bindValue(2, "Web", PDO::PARAM_STR);
//
//$stmt->execute();
//
//var_dump(
//    $stmt->rowCount(),
//    Connect::getInstace()->lastInsertId()
//);


$stmt = Connect::getInstace()->prepare("
    INSERT INTO users (first_name, last_name)
    VALUES(:first_name,:last_name)
");

$stmt->bindValue(":first_name", "Mateus", PDO::PARAM_STR);
$stmt->bindValue(":last_name", "Sampaio", PDO::PARAM_STR);

$stmt->execute();

var_dump([
    $stmt->rowCount()
]);

/*
 * [ bind param ] http://php.net/manual/pt_BR/pdostatement.bindparam.php
 * Usar somente quando quisermos passar referência de uma variável para o bind
 */
fullStackPHPClassSession("stmt bind param", __LINE__);

$stmt = NULL;
$stmt = Connect::getInstace()->prepare('
    INSERT INTO users (first_name, last_name) VALUES (:first_name, :last_name)
');

$first_name = "Ricardo";
$last_name = "Morais";

$stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
$stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);

$stmt->execute();

/*
 * [ execute ] http://php.net/manual/pt_BR/pdostatement.execute.php
 */
fullStackPHPClassSession("stmt execute array", __LINE__);
$stmt = NULL;

$stmt = Connect::getInstace()->prepare("
    INSERT INTO users (first_name, last_name)
    VALUES (:first_name, :last_name)
");

$user = [
  "first_name" => "Kaue",
    "last_name" => "Cardoso",
];

$stmt->execute($user);

var_dump(
    $stmt->rowCount()
);
//$stmt->execute()

/*
 * [ bind column ] http://php.net/manual/en/pdostatement.bindcolumn.php
 * Nomear colunas de uma consulta como variáveis para se usar
 */
fullStackPHPClassSession("bind column", __LINE__);

$stmt = NULL;
$stmt = Connect::getInstace()->prepare("SELECT * FROM users LIMIT 3");

$stmt->execute();
$stmt->bindColumn("first_name", $firstName);
$stmt->bindColumn("email", $email);

while($user = $stmt->fetch()) {
    echo "<p class='trigger accept'>O email de {$firstName} é {$email}</p>";
}