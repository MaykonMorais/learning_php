<?php


namespace Source\Database;

use \PDO;
use \PDOException;

class Connect
{
    private const HOST = "127.0.0.1";
    private const PORT = "3306";
    private const USER = "admin";
    private const DBNAME = "fullstackphp";
    private const PASSWD = "1234";

    private const OPTIONS = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ];

    private static $instace;

    final private function __construct()
    {

    }

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
                    "mysql:host=" . self::HOST . ";dbname=" . self::DBNAME . ";port=" . self::PORT . ";",
                    self::USER,
                    self::PASSWD,
                    self::OPTIONS
                );

            } catch (PDOException $exception) {
                echo "<h1>Whoops! Erro ao conectar...</h1>";
            }
        }
        return self::$instace;
    }
}