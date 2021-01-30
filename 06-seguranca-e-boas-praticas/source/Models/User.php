<?php


namespace Source\Models;

use Source\Core\Model;

/**
 * Class User
 * @package Source\Models
 */
class User extends Model
{
    /** @var array no update or create */
    protected static $safe = ["id", "created_at", "updated_at"];

    /** @var string $entity database table */
    protected static $entity = "users";

    /** @var array $required table fields */
    protected static $required  = ["first_name", "last_name", "email","password"];


    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string|null $document
     * @return $this|null
     */
    public function  bootstrap(string $firstName, string $lastName, string $email,string $password,string $document = null) :?User
    {
        $this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->document = $document;

        return $this;
    }

    /**
     * @param string $terms
     * @param string $params
     * @param string $columns
     * @return User|null
     */
    public function find(string $terms, string $params, string $columns = "*") : ?User
    {
        $find = $this->read("SELECT {$columns} FROM ". self::$entity. " WHERE {$terms}", $params);

        if($this->fail() || !$find->rowCount()) 
        {
            return null;
        }
        return $find->fetchObject(__CLASS__);
    }

    /**
     * @param int $id
     * @param string $columns
     * @return User|null
     */
    public function findById(int $id, string $columns = "*") : ?User
    {
       return $this->find("id = :id", "id={$id}", $columns);
    }

    /**
     * @param $email
     * @param string $columns
     * @return User|null
     */
    public function findByEmail($email, string $columns = "*") : ?User
    {
        return $this->find("email = :email", "email={$email}", $columns);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param string $columns
     * @return array|null
     */
    public function all(int $limit = 30, int $offset = 0, string $columns = "*") : ?array
    {
        $all = $this->read("SELECT {$columns} FROM " .self::$entity." LIMIT :limit OFFSET :offset", "limit={$limit}&offset={$offset}");

        if($this->fail() || !$all->rowCount()) {
            return null;
        }

        return $all->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * @return $this|null
     */
    public function save() : ?User
    {
       
        if(!$this->required()) {
            $this->message()->warning("Nome, sobrenome, email e senha são obrigatórios");
            return null;
        }

        if(!is_email($this->email)) {
            $this->message("Formato inválido de email");
            return null;
        }

        if(!is_passwd($this->password)) {
            $min = CONF_PASSWD_MIN_LEN;
            $max = CONF_PASSWD_MAX_LEN;

            $this->message()->warning("A senha deve ter entre {$min} e {$max} caracteres");
            return null;
        } else {
            $this->password = passwd($this->password);
        }

        /* User Update */
        if(!empty($this->id)) {
            $userId = $this->id;
            
            if($this->find("email = :e AND id != :i", "e={$this->email}&i={$userId}")) {
                $this->message()->warning("Email informado já está cadastrado");
                return null;
            }

            $this->update(self::$entity, $this->safe(), "id = :id", "id={$userId}");

            if($this->fail()) {
                $this->message()->warning("Error ao atualizar, verifique seus dados!");
                return null;
            }
         }

        /* User Create */
        if(empty($this->id)) {

            if($this->findByEmail($this->email)) 
            {
                $this->message()->warning("Email já está cadastrado!");
                return null;
            }

            $userId = $this->create(self::$entity, $this->safe());
            
            // echo "Id " , $userId;

            if($this->fail()) {
                $this->message()->warning("Erro ao cadastrar, verifique seus dados!");
            }
        }

        $this->data = ($this->findById($userId))->data();
        return $this;
    }

    /**
     * @return $this|null
     */
    public function destroy() : ?User
    {
        if(!empty($this->id)) {
            $this->delete(self::$entity, "id = :id", "id={$this->id}");
        }

        if($this->fail()) {
            message()->error("Erro ao remover usuário");
            return null;
        }

        $this->data  = null;

        return $this;
    }
}