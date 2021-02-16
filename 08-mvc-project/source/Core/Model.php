<?php

namespace Source\Core;

abstract class Model
{
  /** @var object|null */
  protected $data;

  /** @var \PDOException|null */
  protected $fail;

  /** @var Message|null */
  protected $message;

  public function __construct()
  {
    $this->message = new Message();
  }

  /**
   * __set
   *
   * @param  string $name
   * @param  mixed $value
   * @return void
   */
  public function __set($name, $value)
  {
    if (empty($this->data)) {
      $this->data = new \stdClass();
    }

    $this->data->$name = $value;
  }

  /**
   * __isset
   *
   * @param  string $name
   * @return void
   */
  public function __isset(string $name)
  {
    return isset($this->data->$name);
  }

  /**
   * __get
   *
   * @param string $name
   * @return void
   */
  public function __get(string $name)
  {
    return ($this->data->$name ??  null);
  }

  public function data(): ?object
  {
    return $this->data;
  }

  public function message(): ?Message
  {
    return $this->message;
  }


  /**
   * create query
   * @param  mixed $entity
   * @param  mixed $data
   * @return void
   */
  protected function create(string $entity, array $data)
  {
    try {
      $columns =  implode(", ", array_keys($data));
      $values  = ":" . implode(", :", array_keys($data));

      $stmt = Connect::getInstance()->prepare("INSERT INTO {$entity} ({$columns}) VALUES ({$values})");

      $stmt->execute($this->filter($data));

      return Connect::getInstance()->lastInsertId();
    } catch (\PDOException $exception) {
      $this->fail = $exception;
      return null;
    }
  }

  /**
   * read query
   * @param  string $select
   * @param  string $params
   * @return PDOStatement
   */
  protected function read(string $select, string $params = null): ?\PDOStatement
  {
    try {
      $stmt = Connect::getInstance()->prepare($select);

      if ($params) {
        parse_str($params, $output);

        foreach ($output as $key => $value) {
          if ($key == 'limit' || $key == 'offset') {
            $stmt->bindValue(":{$key}", $value, \PDO::PARAM_INT);
          } else {
            $stmt->bindValue(":{key}", $value, \PDO::PARAM_STR);
          }
        }

        $stmt->execute();
      }

      $stmt->execute();
      return $stmt;
    } catch (\PDOException $exception) {
      $this->fail = $exception;
      return null;
    }
  }

  protected function update(string $entity, array $data, string $terms, string $params): ?int
  {
    try {
      $dataSet = [];

      foreach ($data as $key => $value) {
        $dataSet[] = "{$key} = :{$key}";
      }

      $dataSet = implode(", ", $dataSet);
      parse_str($params, $output);

      $stmt = Connect::getInstance()->prepare("UPDATE {$entity} SET {$dataSet} WHERE {$terms}");
      $stmt->execute($this->filter(array_merge($data, $params)));

      return ($stmt->rowCount() ?? 1);
    } catch (\PDOStatement $exception) {
      $this->fail = $exception;

      return null;
    }
  }

  protected function delete(string $entity, string $terms, string $params)
  {
    try {
      $stmt = Connect::getInstance()->prepare("DELETE FROM {$entity} WHERE {$terms}");
      parse_str($params, $output);

      $stmt->execute($params);

      return ($stmt->rowCount() ?? 1);
    } catch (\PDOException $exception) {
      $this->fail = $exception;
      return null;
    }
  }

  protected function safe(): ?array
  {
    $safe = (array)$this->data;

    foreach (static::$safe as $unset) {
      unset($safe[$unset]);
    }
    return $safe;
  }

  protected function required(): bool
  {
    $data = (array)$this->data;
    foreach (static::$required as $field) {
      if (empty($data[$field])) {
        return false;
      }
    }
    return true;
  }

  /**
   * filter
   *
   * @param array $values
   * @return array
   */
  private function filter(array $values): ?array
  {
    $filter = [];

    foreach ($values as $key => $value) {
      $filter[$key] = ($value ? filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS) : null);
    }

    return $filter;
  }
}
