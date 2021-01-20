<?php


namespace Source\Interpretation;


class Product
{
    public $name;
    private $price;
    private $data;

    //  executada quando uma determinada propriedade não existe é setada na classe
    public function __set($name, $value)
    {
        $this->notFound(__FUNCTION__, $name);
        $this->data[$name] = $value;
    }

    // executada quando tenta-se acessar uma propriedadade não existente na classe
    public function __get($name)
    {
        if(!empty($this->data[$name])) {
            return $this->data[$name];
        } else {
            $this->notFound(__FUNCTION__, $name);
        }
    }

    // executado quando uma propriedade inexistente é acessada ou vazia
    public function __isset($name)
    {
        $this->notFound(__FUNCTION__, $name);
    }

    // executada quando um método inexistente é chamado
    public function __call($name, $arguments)
    {
        $this->notFound(__FUNCTION__, $name);
        var_dump($arguments);
    }

    public function __toString()
    {
        return "<p class='trigger'> Esse é um objeto da classe".__CLASS__."</p>";
    }

    public function __unset($name)
    {
        trigger_error(__FUNCTION__.": Acesso negado a propriedade {$name}", E_USER_ERROR);

    }

    public function handler($name, $price)  {
        $this->name = $name;
        $this->price = number_format($price, "2", ",", ".");
    }

    private function notFound($method, $name) {
        echo "<p class='trigger error'>{$method}: A propriedade {$name} não existe em ".__CLASS__."!</p>";
    }



}