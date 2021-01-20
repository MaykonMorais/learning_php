<?php


namespace Source\Interpretation;


class User
{
    private $firstName;
    private $lastName;
    private $email;


    public function __construct($firstName, $lastName, $email)
    {
        $this->firstName  = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public function __clone()
    {
        $this->firstName = null;
        $this->lastName = null;

        echo "<p class='trigger'>Clonou!</p>";
    }

    public function __destruct()
    {
        echo "<p class='trigger accept'>Objeto {$this->firstName} foi destruido</p>";
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }



}