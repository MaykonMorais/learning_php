<?php

namespace Source\Core;

class Session
{

  public function __construct()
  {
    if (!session_id()) {
      session_start();
    }
  }

  public function __get($name)
  {
    if (!empty($_SESSION[$name])) {
      return $_SESSION[$name];
    }

    return null;
  }

  /**
   * set new proprieday or value to session
   * @param  string $key
   * @param  mixed $value
   * @return void
   */
  public function set(string $key, $value): Session
  {
    $_SESSION[$key] = (is_array($value) ? (object)$value : $value);

    return $this;
  }


  public function __isset($name): bool
  {
    return $this->has($name);
  }
  /**
   * Verify if propriety exists
   * @param  mixed $name
   * @return bool
   */
  private function has(string $name): bool
  {
    return isset($_SESSION[$name]);
  }

  /**
   * unset
   *
   * @param  mixed $key
   * @return bool
   */
  public function unset(string $key): Session
  {
    unset($_SESSION[$key]);
    return $this;
  }

  public function regenerate()
  {
    session_regenerate_id(true);
    return $this;
  }

  /**
   * Remove session
   * @return Session
   */
  public function destroy(): Session
  {
    session_destroy();
    return $this;
  }

  /**
   * 
   * @return Message|null
   */
  public function flash(): ?Message
  {
    if ($this->has("flash")) {
      $flash = $this->flash;
      $this->unset("flash");
      return $flash;
    }

    return null;
  }

  /**
   * CSRF Token
   * @return void
   */
  public function csrf(): void
  {
    $_SESSION['csrf_token'] = base64_encode(random_bytes(20));
  }
}
