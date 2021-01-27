<?php

/*
 * DATABASE
 * */

define("CONF_DB_HOST", "127.0.0.1");
define("CONF_DB_USER", "admin");
define("CONF_DB_PASS", "1234");
define("CONF_DB_NAME", "fullstackphp");
define("CONF_DB_PORT", "3306");

/*
 * PROJECT URLs
 * */

define("CONF_URL_BASE", "http://localhost/fsphp/06-seguranca-e-boas-pra ticas/06-08-camada-de-manipulacao-pt3");
define("CONF_URL_ADMIN", CONF_URL_BASE."/admin");
define("CONF_URL_ERROR", CONF_URL_BASE."/404");

/*
 * DATES
 * */

define("CONF_DATE_BR","d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/*
 * Session
 * */
define("CONF_SES_PATH", __DIR__."/../../storage/sessions");

/*
 * MESSAGE
 * */

define("CONF_MESSAGE_CLASS", "trigger");
define("CONF_MESSAGE_INFO", "info");
define("CONF_MESSAGE_SUCCESS", "success");
define("CONF_MESSAGE_WARNING", "warning");
define("CONF_MESSAGE_ERROR", "error");


/**
 * PASSWORD
 */

define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

