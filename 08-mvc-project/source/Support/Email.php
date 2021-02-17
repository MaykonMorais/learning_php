<?php

namespace Source\Support;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use stdClass;

class Email
{
  /** @var object */
  private $data;

  /** @var PHPMailer */
  private $mail;

  /** @var Message */
  private $message;


  public function __construct()
  {

    try {
      $this->mail = new PHPMailer(true);

      $this->mail->isSMTP();
      $this->mail->setLanguage(CONF_MAIL_OPTIONS_LANG);
      $this->mail->isHTML(CONF_MAIL_OPTIONS_HTML);
      $this->mail->SMTPAuth = CONF_MAIL_OPTIONS_AUTH;
      $this->mail->SMTPSecure =  CONF_MAIL_OPTIONS_SECURE;
      $this->mail->CharSet = CONF_MAIL_OPTIONS_CHARSET;

      $this->mail->Host = CONF_MAIL_HOST;
      $this->mail->Port = CONF_MAIL_PORT;
      $this->mail->Username = CONF_MAIL_USERNAME;
      $this->mail->Password = CONF_MAIL_PASSWD;
    } catch (Exception $exception) {
      $this->message  = $exception;
      return null;
    }
  }

  /**
   * bootstrap data message
   * @param  string $subject
   * @param  string $message
   * @param  string $toEmail
   * @param  string $toName
   * @return void
   */
  public function bootstrap(string $subject, string $message, string $toEmail, string $toName): Email
  {
    $this->data = new \stdClass();
    $this->data->subject = $subject;
    $this->data->message = $message;
    $this->data->toEmail = $toEmail;
    $this->data->toName = $toName;

    return $this;
  }

  /**
   * attach  file
   * @param  string $filePath
   * @param  string $fileName
   * @return Email
   */
  public function attach(string $filePath, string $fileName): Email
  {
    $this->data->attach[$filePath] = $fileName;
    return $this;
  }

  /**
   * send email
   * @param  mixed $fromEmail
   * @param  mixed $fromName
   * @return void
   */
  public function send(string $fromEmail = CONF_MAIL_SENDER['address'], string $fromName = CONF_MAIL_SENDER['name']): bool
  {
    if (empty($this->data)) {
      $this->message()->error("Erro ao enviar, verifique seus dados!");
      return false;
    }

    if (!is_email($this->data->toEmail)) {
      $this->message()->warning("Email inválido. Digite um email válido");
      return false;
    }

    if (!is_email($fromEmail)) {
      $this->message()->warning("Email de origem é inválido");
      return false;
    }

    try {
      $this->mail->Subject  = $this->data->subject;
      $this->mail->msgHTML($this->data->message);
      $this->mail->addAddress($this->data->toEmail, $this->data->toName);

      $this->mail->setFrom($fromEmail, $fromName);

      if (!empty($this->data->attach)) {
        foreach ($this->data->attach as $path =>  $name) {
          $this->mail->addAttachment($path, $name);
        }
      }

      $this->mail->send();

      return true;
    } catch (\Exception $exception) {
      $this->message()->error($exception);
      return false;
    }
  }

  /**
   * message
   * @return Message
   */
  public function message(): Message
  {
    return $this->message;
  }

  /**
   * mail
   *
   * @return PHPMailer
   */
  public function mail(): PHPMailer
  {
    return $this->mail;
  }
}
