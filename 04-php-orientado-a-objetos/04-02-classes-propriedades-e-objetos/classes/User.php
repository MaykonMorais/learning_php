<?php


class User
{
    public $firstName;
    public $lastName;
    public $email;

    /**
     * @return mixed
     */
    public function getFirstName()
    {
       return $this->firstName;
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
        $this->lastName = filter_var($lastName, FILTER_SANITIZE_STRIPPED);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * @param $email
     * @return false
     */
    public function setEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return false;
        }
        else {
            return false;
        }

    }

    public function setFirstName($firstName)
    {
        $this->firstName = filter_var($firstName, FILTER_SANITIZE_STRIPPED);
    }






}