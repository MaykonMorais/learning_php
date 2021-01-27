<?php

use Source\Core\Message;
use Source\Core\Session;

/**
 * Validar email
 * @param string $email
 * @return bool
 */
function is_email(string $email) : bool
{
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Validar senha do usuário (somente tamanho)
 * @param string $password
 * @return bool
 */
function is_passwd(string $password) : bool
{
  return (mb_strlen($password) >= CONF_PASSWD_MIN_LEN && mb_strlen($password) <= CONF_PASSWD_MAX_LEN);
}


/**
 * Transformar uma string em uma URL ou URI  (Helper Slug)
 * @param string $string
 * @return string
 */
function str_slug(string $string) : string
 {
   $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
   $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
   $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

   // substituição dos caracteres
   $slug = str_replace(['-----', '----', '---', '--'], "-", 
     str_replace(" ", "-", 
      trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))));
  
   return $slug;
 };

/**
* Converter uma requisição em um nome de classe e compor o MVC
 *@param string string
 *@return string
*/
function str_studly_case(string $string) : string
{
  $string = str_slug($string);
  $studlyCase = str_replace(" ", "", 
    mb_convert_case(str_replace('-', ' ', $string),  MB_CASE_TITLE)
  );

  return $studlyCase;
}

/**
 * Converte para camel case a string url
 * @param string $string
 * @return string
 */
function str_camel_case(string $string) : string 
{
  $camelCase = lcfirst(str_studly_case($string));

  return $camelCase;
};

/**
 * Converte a string para o formato title sendo tratada
 * @param string $string
 * @return string
 */
function str_title(string $string) : string 
{
  $string = filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS);
  return mb_convert_case($string, MB_CASE_TITLE);
};


/**
 * Quantidade limite de palavras
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function str_limit_words(string $string, int $limit, string $pointer = '...') : string
{
  $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
  $arrWords = explode(" ", $string);
  $numWords = count($arrWords);

  if($numWords < $limit) {
    return $string;
  }

  $words = implode(" ", array_slice($arrWords, 0, $limit));

  return "{$words}{$pointer}";
}


/**
 * Quantidade limite de caracteres
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function str_limit_chars(string $string, int $limit, string $pointer = '...') : string
{
  $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));

  if(mb_strlen($string) <= $limit) {
    return $string;
  }

  $chars = mb_substr($string, 0 ,mb_strrpos(mb_substr($string, 0, $limit), " "));

  return "{$chars}{$pointer}";
}

/**
 * Definição da url
 * @param string $url
 * @return string
 */
function url(string $path) : string
{
  return CONF_URL_BASE."/".($path[0] == "/" ? mb_substr($path, 1) : $path);
}

/**
 * Redirecionamento da página
 * @param string $url
 */
function redirect(string $url) : void
{
  header("HTTP/1.1 302 Redirect"); 
  if(filter_var($url, FILTER_VALIDATE_URL)) 
  {
    header("Location:  {$url}");
    exit;
  }

  $location = url($url);
  header("Location:  {$location}");

  exit;
}

// CORE TRIGGERS
 
/**
 * Retornar uma instância pronta para uso do banco de dados
 * @return PDO
 */
function db() : PDO
{
  return \Source\Core\Connect::getInstace();
}

/**
 * @return Message
 */
function message() : Message
{
  return new Message();
}

/**
 * @return Session
 */
function session() : Session 
{
  return new Session();
}

/**
 * @return \Source\Models\User
 */
function user() : \Source\Models\User
{
  return new \Source\Models\User();
}


// PASSWORD HANDLES

/**
 * Geração de senha encapsulada
 * @param string $password
 * @return string
 */
function passwd(string $password) : string
{
  return password_hash($password, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
}

/**
 * Verificação de Senha
 * @param string $password
 * @param string $hash
 * @return bool
 */
function passwd_verify(string $password, string $hash) : bool
{
  return password_verify($password, $hash);
}


/**
 * Verificação para necesidade de gerar novo hash
 * @param string $hash
 * @return bool
 */
function passwd_rehash(string $hash) : bool 
{
  return password_needs_rehash($hash, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION); 
}