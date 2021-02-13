<?php

namespace Source\Core;

class Message
{
  private $text;
  private $type;

  public function getText(): ?string
  {
    return $this->text;
  }

  public function getType(): ?string
  {
    return $this->type;
  }

  public function success(string $message): Message
  {
    $this->type = CONF_MESSAGE_SUCCESS;
    $this->text = $this->filter($message);

    return $this;
  }

  public function error(string $message): Message
  {
    $this->type = CONF_MESSAGE_ERROR;
    $this->text = $this->filter($message);

    return $this;
  }

  public function info(string $message): Message
  {
    $this->type = CONF_MESSAGE_INFO;
    $this->text = $this->filter($message);

    return $this;
  }

  public function warning(string $message): Message
  {
    $this->type = CONF_MESSAGE_WARNING;
    $this->text = $this->filter($message);

    return $this;
  }

  public function render(): string
  {
    return "<div class='" . CONF_MESSAGE_CLASS . " {$this->getType()}" . "'>{$this->getText()}</div>";
  }


  public function json(): string
  {
    return \json_encode(['error' => $this->getText()]);
  }

  public function flash(): void
  {
    (new Session())->set("flash", $this);
  }

  private function filter(string $message)
  {
    return filter_var($message, FILTER_SANITIZE_STRIPPED);
  }
}
