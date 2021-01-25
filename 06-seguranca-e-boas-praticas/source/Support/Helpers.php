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


function str_camel_case(string $string) : string 
{
  $camelCase = lcfirst(str_studly_case($string));

  return $camelCase;
};

