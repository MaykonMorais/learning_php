<?php

use Dotenv\Dotenv;

$envs = Dotenv::createImmutable(__DIR__ . "/../..");
$envs->load();

/**
 * DATABASE
 */
define("CONF_DB_HOST", "127.0.0.1");
define("CONF_DB_USER", "admin");
define("CONF_DB_PASS", "1234");
define("CONF_DB_NAME", "fullstackphp");
define("CONF_DB_PORT", "3306");

/**
 *  SESSION
 */
define("CONF_SES_PATH", __DIR__ . "/../../storage/sessions/");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);


/**
 * MESSAGE
 */
define("CONF_MESSAGE_CLASS", "trigger");
define("CONF_MESSAGE_INFO", "info");
define("CONF_MESSAGE_SUCCESS", "success");
define("CONF_MESSAGE_WARNING", "warning");
define("CONF_MESSAGE_ERROR", "error");
