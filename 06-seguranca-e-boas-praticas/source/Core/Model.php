<?php


namespace Source\Core;

/*
 * Stateless -> As propriedades não irão implementar as regras de negócio, e sim, rotinas
 * */

/**
 * Class Model
 * @package Source\Core
 */

abstract class Model
{
    /** @var object|null */
    protected $data;

    /** @var \PDOException|null */
    protected $fail;

    /** @var Message|null  */
    protected $message;

    /**
     * Model constructor
     */
    public function __construct()
    {
        $this->message = new Message();
    }

    /**
     * @param string $name
     * @param $value
     */
    public function __set(string $name, $value): void
    {
        if(empty($this->data)) {
            $this->data = new \stdClass();

        }

        $this->data->$name =$value;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset(string $name): bool
    {
       return isset($this->data->$name);
    }

    /**
     * @param string $name
     * @return null
     */
    public function __get(string $name)
    {
        return $this->data->$name ?? null;
    }

    /**
     * @return object|null
     */
    public function data(): ?object
    {
        return $this->data;
    }

    /**
     * @return ?\PDOException
     */
    public function fail(): ?\PDOException
    {
        return $this->fail;
    }

    /**
     * @return Message|null
     */
    public function message(): ?Message
    {
        //var_dump($this->message);
        return  $this->message;
    }

    /**
     * @param string $entity
     * @param array $data
     * @return int|null
     */
    protected function create(string $entity, array $data) : ?int
    {
       try {
            $columns = implode(", ", array_keys($data));
            $values = ":".implode(", :", array_keys($data));

            $stmt = Connect::getInstace()->prepare("INSERT INTO {$entity} ({$columns}) VALUES ({$values})");
            
            $stmt->execute($this->filter($data));
            
            return Connect::getInstace()->lastInsertId();
       } catch (\PDOException $exception) {
           $this->fail =  $exception;
           return null;
       }
    }

    /**
     * @param string $select
     * @param string|null $params
     * @return \PDOStatement|null
     */
    protected function read(string $select, string $params = null) : ?\PDOStatement
    {
         try {
            $stmt = Connect::getInstace()->prepare($select);
            
            if($params) {
                parse_str($params, $params); // tranform to array the params

                foreach ($params as $key => $value) {
                    $type = (is_numeric($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
                    $stmt->bindValue(":{$key}", $value, $type);
                }
            }

            $stmt->execute();

            return $stmt;

         } catch (\PDOException  $exception) {
             $this->fail = $exception;

             return null;
         }
    }

    protected function update(string $entity, array $data, string $terms, string $params) {
        
        try {
            $dataSet = [];

            foreach ($data as $key => $value) {
                $dataSet[] =  "{$key} = :{$key}";
            }

            $dataSet = implode(", ", $dataSet);
            parse_str($params, $params);

            $stmt = Connect::getInstace()->prepare("UPDATE {$entity} SET {$dataSet} WHERE {$terms}");
            
            $stmt->execute($this->filter(array_merge($data, $params)));
            
            return $stmt->rowCount() ??  1;

        } catch(\PDOException $exception) {
            $this->fail = $exception;

            return null;
        }
    }

    /**
     * @param string $entity
     * @param string $terms
     * @param string $params
     * @return int|null
     */
    protected function delete(string $entity, string $terms, string $params) : ?int
    {
        try {
            $stmt = Connect::getInstace()->prepare("DELETE FROM {$entity} WHERE {$terms}");
            parse_str($params, $params);

            $stmt->execute($params);

            return ($stmt->rowCount() ?? 1);

        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }
    
    /**
     * Retira propriedades que são geradas automaticamente (id, created_at, updated_at)
     * @return array|null
     */
    protected function safe() :?array
    {
        $safe = (array)$this->data;

        // o static acessa uma propriedade estática que está em uma classe filha
        foreach (static::$safe as $unset) {
             unset($safe[$unset]);
        }

        return $safe;
    }

    /**
     * Realiza filtro dos dados passados ($data)
     * @param array $data
     * @return array|null
     */
    protected function filter(array $data) : ?array
    {
        $filter = [];
      
        foreach ($data as $key => $value) {
            $x = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            $filter[$key] = (is_null($value) ? null : $x);            
        }

        return $filter;
    }


    protected function required() : bool
    {
        $data = (array)$this->data();
        
        foreach(static::$required as $field) {
            if(empty($data[$field])) {
               return false; 
            }
        }

        return true;
    }
}