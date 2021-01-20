<?php


namespace Source\Models;

/*
 * Stateless -> As propriedades não irão implementar as regras de negócio, e sim, rotinas
 * Statefull ->
 * */

use Source\Database\Connect;

abstract class Model
{
    /** @var object|null */
    protected $data;

    /** @var \PDOException|null */
    protected $fail;

    /** @var string|null  */
    protected $message;

    public function __set(string $name, $value): void
    {
        if(empty($this->data)) {
            $this->data = new \stdClass();

        }

        $this->data->$name =$value;
    }

    public function __isset(string $name): bool
    {
       return isset($this->data->$name);
    }

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
     * @return string|null
     */
    public function message(): ?string
    {
        return $this->message;
    }

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

    protected function update() {

    }

    protected function delete() {

    }

    // retira propriedades que são geradas automaticamente (id, created_at, updated_at)
    protected  function safe() :?array
    {
        $safe = (array)$this->data;

        // o static acessa uma propriedade estática que está em uma classe filha
        foreach (static::$safe as $unset) {
             unset($safe[$unset]);
        }

        return $safe;
    }

    /*
     * Realiza filtro dos dados passados ($data)
     * */
    protected function filter(array $data) : ?array
    {
        $filter = [];

        foreach ($data as $key => $value) {
            $filter[$key] = (is_numeric($value) ? null : filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS));
        }

        return $filter;
    }
}