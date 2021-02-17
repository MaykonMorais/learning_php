<?php


/**
 *  VALIDATIONS
 */

/**
 * @param string $email
 * @return bool
 */
function is_email(string $email): bool
{
  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * @param string $password
 * @return bool
 */
function is_passwd(string $password): bool
{
  if (password_get_info($password)['algo']) {
    return true;
  }

  return (mb_strlen($password) >= CONF_PASSWD_MIN_LEN && mb_strlen($password) <= CONF_PASSWD_MAX_LEN ? true : false);
}

/**
 * @param string $password
 * @return string
 */
function passwd(string $password): string
{
  return password_hash($password, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
}

/**
 * @param string $password
 * @param string $hash
 * @return bool
 */
function passwd_verify(string $password, string $hash): bool
{
  return password_verify($password, $hash);
}

/**
 * @param string $hash
 * @return bool
 */
function passwd_rehash(string $hash): bool
{
  return password_needs_rehash($hash, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
}

/** DATE FORMATS */

/**
 * Convert date into default date
 * @param  string $date
 * @param  string $format
 * @return string
 */
function date_fmt(string $date = "now", string $format = "d/m/Y H\hi"): string
{
  return (new DateTime($date))->format($date);
}


/**
 * Convert date into APP Date
 * @param  string $date
 * @return void
 */
function date_fmt_app(string $date = "now"): string
{
  return (new DateTime($date))->format(CONF_DATE_APP);
}

/**
 * Convert date into Brazilizian Date
 * @param  string $date
 * @return string
 */
function date_fmt_br(string $date = "now")
{
  return (new DateTime($date))->format(CONF_DATE_BR);
}


/** STRINGS */

function str_slug(string $string): string
{
  $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
  $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
  $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

  $slug = str_replace(
    ["-----", "----", "---", "--"],
    "-",
    str_replace(
      " ",
      "-",
      trim(strstr(utf8_decode($string), utf8_decode($formats), $replace))
    )
  );

  return $slug;
}


/**
 * @param  string $string
 * @return string
 */
function str_studly_case(string $string): string
{
  $string =  str_slug($string);
  $studlyCase = str_replace(" ", "", mb_convert_case(str_replace("-", " ", $string), MB_CASE_TITLE));

  return  $studlyCase;
}

/**
 * @param  string $string
 * @return string
 */
function str_camel_case(string $string): string
{
  return lcfirst(str_studly_case($string));
}


/*
 * @param  string $string
 * @return string
 */
function str_title(string $string): string
{
  return mb_convert_case(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS), MB_CASE_TITLE);
}

/**
 * str_limit_words
 *
 * @param  string $string
 * @param  string $limit
 * @param  string $pointer
 * @return string
 */
function str_limit_words(string $string, int $limit, string $pointer = "..."): string
{
  $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
  $arrayWords = explode(" ", $string);
  $numWords = count($arrayWords);

  if ($numWords < $limit) {
    return $string;
  }

  $words = implode("  ", array_slice($arrayWords, 0, $limit));
  return "{$words}{$pointer}";
}


function str_limit_chars(string $string, int $limit, $pointer = '...')
{
  $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));

  if (mb_strlen($string) < $limit) {
    return $string;
  }

  $chars = mb_substr($string, 0, mb_strrpos(mb_substr($string, 0, $limit), " "));
  return "{$chars}{$pointer}";
}
