<?php


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