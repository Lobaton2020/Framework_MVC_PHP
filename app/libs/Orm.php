<?php

class Orm extends Base
{

    private $table;

    public function __construct($table)
    {
        parent::__construct();
        $this->table = $table;
    }

    public function getAll($type = "asc")
    {
        $this->querye("SELECT * FROM {$this->table} ORDER BY '{$type}'");
        $this->execute();
        return $this->fetchAll();
    }

    public function getById($id, $value)
    {
        $this->querye("SELECT * FROM {$this->table} WHERE {$id} = :idvalue");
        $this->bind(":idvalue", $value);
        $this->execute();
        return $this->fetch();
    }

    public function getBy($column, $value)
    {
        $this->querye("SELECT * FROM {$this->table} WHERE {$column} = :columnvalue");
        $this->bind(":columnvalue", $value);
        $this->execute();
        return $this->fetchAll();
    }

    public function deleteById($id, $value)
    {
        $this->querye("DELETE FROM {$this->table} WHERE {$id} = :idcolumn");
        $this->bind(":idcolumn", $value);
        return $this->execute();
    }

    public function deleteBy($column, $value)
    {
        $this->querye("SELECT * FROM {$this->table} WHERE {$column} = :columnvalue");
        $this->bind(":columnvalue", $value);
        return $this->execute();
    }

    // aqui pueden ir otros metodos automaticos
    // metodos para insertar datos con bucles
    // metodos para actualizar datos con bucles
}
