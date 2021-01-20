<?php


namespace Source\Models;

use Source\App\User;

class UserModel extends Model
{
    /** @var array no update or create */
    protected static $safe = ["id", "created_at", "updated_at"];

    /** @var string $entity database table */
    protected static $entity = "users";


    public function  bootstrap(string $firstName, string $lastName, string $email, string $document = null) :?UserModel
    {
        $this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->email = $email;
        $this->document = $document;

        return $this;
    }

    public function load(int $id, string $columns = "*") : ?UserModel
    {
        $load = $this->read("SELECT {$columns} FROM ".self::$entity." WHERE id = :id", "id={$id}");

        if($this->fail() || !$load->rowCount()) {
            $this->message = "User not found by id";

            return null;
        }
        return $load->fetchObject(__CLASS__);
    }

    public function find($email, string $columns = "*") : ?UserModel
    {
        $find = $this->read("SELECT {$columns} FROM ".self::$entity." WHERE email = :email", "email={$email}");

        if($this->fail() | !$find->rowCount()) {
            $this->message = "User not found by email";

            return null;
        }

        return $find->fetchObject(__CLASS__);
    }

    public function all(int $limit = 30, int $offset = 0, string $columns = "*") : ?array
    {
        $all = $this->read("SELECT {$columns} FROM " .self::$entity." LIMIT :l OFFSET :o", "l={$limit}&o={$offset}");

        if($this->fail() || !$all->rowCount()) {
            $this->message = "Consult returned nothing";

            return null;
        }

        return $all->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    public function save() : ?UserModel
    {

        if(!$this->required()) {
            return null;
        }

        /* User Update */
        if(!empty($this->id)) {
            $userId = $this->id;
        }

        /* User Create */
        if(empty($this->id)) {
            if($this->find($this->email)) {
                $this->message = "email has been used";

                return null;
            }

            $userId = $this->create(self::$entity, $this->safe());

            if($this->fail()) {
                $this->message = "Ops! Error during register. Verify your data";
            }

            $this->message = "Success! Register Accepted";
        }

        $this->data = $this->read("SELECT * FROM users WHERE id = :id", "id={$userId}")->fetch();
        return $this;
    }

    public function destroy() {

    }

    private function required() : bool
    {
        if(empty($this->first_name) || empty($this->last_name) || empty($this->last_name) || empty($this->email)) {
            $this->message = "First name, last name and email are required";

            return false;
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->message = "Invalid email";
            return false;
        }

        return true;
    }
}