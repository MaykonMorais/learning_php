<?php


namespace Source\Database\Entity;


class UserEntity
{
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $document;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getDocument()
    {
        return $this->document;
    }


}