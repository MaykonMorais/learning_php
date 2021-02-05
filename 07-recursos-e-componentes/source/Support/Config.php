<?php

require __DIR__."/../../vendor/vlucas/phpdotenv/src/Dotenv.php";

use Dotenv\Dotenv;

$envs = Dotenv::createImmutable(__DIR__."/../..");
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
 * PROJECT URLs
 */
define("CONF_URL_BASE", "https://www.localhost/fsphp/06-seguranca-e-boas-praticas/06-08-camada-de-manipulacao-pt3");
define("CONF_URL_ADMIN", CONF_URL_BASE . "/admin");
define("CONF_URL_ERROR", CONF_URL_BASE . "/404");

/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * SESSION
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

/** VIEW */
define("CONF_VIEW_PATH", __DIR__."/../assets/views");
define("CONF_VIEW_EXT", "php") ;

/** UPLOAD */
define("CONF_UPLOAD_DIR", "../storage/uploads");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/** IMAGES */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/". CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_CACHE_OPTIONS", ["jpeg_quality" => 75, "png_compression_level" => 5]);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/** MAIL */

define("CONF_MAIL_HOST", $_ENV['MAIL_HOST']);
define("CONF_MAIL_PORT", $_ENV['MAIL_PORT']);
define("CONF_MAIL_USER", $_ENV['MAIL_USERNAME']);
define("CONF_MAIL_PASS", $_ENV['MAIL_PASSWORD']);
define("CONF_MAIL_SENDER", ["name" => "Maykon Morais", "address" => "maykons501@gmail.com"]);


/** MAIL OPTIONS */

define("CONF_MAIL_OPTIONS_LANG", "br");
define("CONF_MAIL_OPTIONS_HTML", true);
define("CONF_MAIL_OPTIONS_AUTH", true);
define("CONF_MAIL_OPTIONS_SECURE", $_ENV['MAIL_ENCRYPTION']);
define("CONF_MAIL_OPTIONS_CHARSET", "utf-8");
