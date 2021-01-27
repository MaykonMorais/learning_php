<?php


namespace Source\Core;


/**
 * Class Session
 * @package Source\Core
 */
class Session
{
    /**
     * Session constructor.
     */
    public function __construct()
    {
        if(!session_id()) {
            session_save_path(CONF_SES_PATH);
            session_start();
        }
    }


    /**
     * @param string $name
     * @return mixed|null
     */
    // quando acessar, por exemplo, $session->user ser redirecionado para $_SESSION[user]
    public function __get(string $name)
    {
        if(!empty($_SESSION[$name])) {
            return $_SESSION[$name];
        }

        return null;
    }

    public function __isset(string $name): bool
    {
        return $this->has($name);
    }

    // obter sessão
    public function all() : ?object
    {
        return (object)$_SESSION;
    }

    public function set(string $key, $value) : Session
    {
        $_SESSION[$key] = (is_array($value) ? (object)$value : $value);
        return $this;
    }

    public function unset(string $key) :Session
    {
        unset($_SESSION[$key]);
        return $this;
    }

    // verificar se determinada propriedade é existente
    public function has(string $key)
    {
        return isset($_SESSION[$key]);
    }

    // renovando sessão -> Irá gerar um novo session_id, remove e criar um novo arquivo de sessão
    public function regenerate() : Session
    {
        session_regenerate_id(true);
        return $this;
    }

    public function destroy() : Session
    {
        session_destroy();
        return $this;
    }

    /**
     * @return Message|null
     */
    public function flash() :?Message
    {
        if($this->has("flash")) {
            $flash = $this->flash;

            $this->unset("flash");

            return $flash;
        }
        return null;
    }

    /**
     * CSRF Token
     */
    public function csrf() : void 
    {
        $_SESSION['csrf_token'] = base64_encode(random_bytes(20));
    }

}