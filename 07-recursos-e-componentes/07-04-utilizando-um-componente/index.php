<?php

require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("07.04 - Utilizando um componente");

require __DIR__ . "/../vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__."/..");
$dotenv->load();



/*
 * [ instance ] https://packagist.org/packages/phpmailer/phpmailer
 */
fullStackPHPClassSession("instance", __LINE__);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;

// $phpMailer = new PHPMailer();

// var_dump($phpMailer instanceof PHPMailer);

try {
  $mail = new PHPMailer(true);

  //CONFIG
  $mail->isSMTP();
  $mail->setLanguage('br');
  $mail->isHTML(true);
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls';
  $mail->CharSet =  'utf-8';

  // AUTH
  $mail->Host  = $_ENV['MAIL_HOST'];
  $mail->Username = $_ENV['MAIL_USERNAME'];
  $mail->Password = $_ENV['MAIL_PASSWORD'];
  $mail->Port = $_ENV['MAIL_PORT'];

  // MAIL
  $mail->setFrom("f39ad105b2-19690d@inbox.mailtrap.io", "Maykon Morais");
  $mail->Subject = "Este é meu envio via componente PHPMailer";
  $mail->msgHTML("<h1>Hey! This is a short message for you! You're Awesome!</h1>");

  // SEND
  $mail->addAddress("maykon.estudos@gmail.com", "Maykon Morais");
  $send = $mail->send();

  var_dump($send);


} catch (MailException $exception) {
  message()->error($exception->getMessage());
}

/*
 * [ configure ]
 */
fullStackPHPClassSession("configure", __LINE__);