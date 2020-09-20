<?php


class Model
{

    private $table;
    private $primaryKey;
    protected $base;
    public function __construct($table = null, $primaryKey = null)
    {
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->base = Base::connect();
    }

    public function select($columns = "*", $order = "DESC", $limit = 100)
    {
        if (is_array($columns)) {
            $columns = implode(",", $columns);
        }
        return $this->base->query("SELECT {$columns} FROM {$this->table} ORDER BY {$this->primaryKey} {$order} LIMIT {$limit}")->fetchAll();
    }

    public function get($id, $columns = "*", $limit = 100)
    {
        if (is_array($columns)) {
            $columns = implode(",", $columns);
        }

        $stmt = $this->base->prepare("SELECT {$columns} FROM {$this->table} WHERE {$this->primaryKey} = :{$this->primaryKey} ");
        $stmt->bindParam(":{$this->primaryKey}", $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function insert($data)
    {
        try {

            $params_columns = "";
            $keys = array_keys($data);
            $columns = implode(",", $keys);
            foreach ($keys as $key) {
                $params_columns .= "?,";
            }
            $params_columns = substr($params_columns, 0, -1);
            $stmt = $this->base->prepare("INSERT INTO {$this->table} ({$columns}) VALUES ({$params_columns})");
            return $stmt->execute(array_values($data));
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function update($data)
    {
        try {
            $params_columns = "";
            $keys = array_keys($data);
            array_pop($keys);
            foreach ($keys as $key) {
                $params_columns .= $key . " = ?,";
            }
            $params_columns = substr($params_columns, 0, -1);
            $stmt = $this->base->prepare("UPDATE  {$this->table} SET {$params_columns} WHERE  {$this->primaryKey} = ?");
            return $stmt->execute(array_values($data));
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function delete($id, $limit = 1)
    {
        try {
            $stmt = $this->base->prepare("DELETE FROM  {$this->table} WHERE  {$this->primaryKey} = ? LIMIT {$limit}");
            return $stmt->execute([$id]);
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
}
