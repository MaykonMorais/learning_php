<?php


namespace Source\Core;

use \PDO;
use \PDOException;

/**
 * Class Connect
 * @package Source\Core
 */
class Connect
{

    private const OPTIONS = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ];

    private static $instace;

    /**
     * Connect constructor.
     */
    final private function __construct()
    {

    }

    /**
     * Connect clone
     */
    final  function __clone(): void
    {
        // TODO: Implement __clone() method.
    }

    /**
     * @return PDO
     */
    public static function getInstace(): PDO
    {
        if (empty(self::$instace)) {
            try {
                self::$instace = new PDO(
                    "mysql:host=" . CONF_DB_HOST . ";dbname=" . CONF_DB_NAME . ";port=" . CONF_DB_PORT . ";",
                    CONF_DB_USER,
                    CONF_DB_PASS,
                    self::OPTIONS
                );

            } catch (PDOException $exception) {
                echo "<h1>Whoops! Erro ao conectar...</h1>";
            }
        }
        return self::$instace;
    }
}