<?php


namespace Source\Traits;

// traço de comportamento que pode ser replicado em outras classes
trait UserTrait
{
    private $user;

    /**
     * @return User
     */
    public function getUser() : User
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }


}