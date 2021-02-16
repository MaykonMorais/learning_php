<?php


namespace Source\Traits;


class Register
{
    use UserTrait; // importação das propriedades e comportamentos dos traits para a classe
    use AddressTrait;

    public function __construct(User $user, Address $address)
    {
        $this->setUser($user);
        $this->setAddress($address);

        $this->save();
    }

    private function save() {
        $this->user->id = 232;
        $this->address->user_id = $this->user->id;
    }
}