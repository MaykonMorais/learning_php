<?php


namespace Source\Contracts;


class UserAdmin extends User implements UserInterface, UserErrorInterface
{
    private $level;
    private $error;

    public function __construct($firstName, $lastName, $email)
    {
        parent::__construct($firstName, $lastName, $email);
        $this->level = 10;
    }

    /**
     * @param mixed $error
     */
    public function setError($error): void
    {
        $this->error = $error;
    }

    public function getError($error)
    {
        return $this->error;
    }


}