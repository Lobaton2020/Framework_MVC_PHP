<?php

class Orm extends Base
{

    private $table;

    public function __construct($table)
    {
        parent::__construct();
        $this->table = $table;
    }

    /**
     * @param Array (Numeric) or String $select 
     * @param Array $where - Asociative
     * ej:select("*", ["iduser[>]" => 20])
     */
    public function select($select = "*", $where = null, $limit = 20, $type = "asc")
    {
        $where = $this->whereToString($where);
        if (is_array($select)) {
            $select = implode(",", $select);
        }
        if (!isset($where["string"])) {
            $where["string"] = "";
        }
        try {
            $this->querye("SELECT {$select} FROM {$this->table} {$where["string"]} ORDER BY '{$type}' limit $limit");
            if (!empty($where["string"])) {
                $this->bind(":" . $where["field"], $where["value"]);
            }
            $this->execute();
            return new JSON($this->fetchAll());
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    /**
     * @param Array (Numeric) or String $select 
     * @param Array $where - Asociative
     * ej:select("*", ["iduser[>]" => 20])
     * Only return a register
     */
    public function get($select = "*", $where = null, $type = "asc")
    {
        $where = $this->whereToString($where);
        if (is_array($select)) {
            $select = implode(",", $select);
        }
        if (!isset($where["string"])) {
            $where["string"] = "";
        }
        try {
            $this->querye("SELECT {$select} FROM {$this->table} {$where["string"]} ORDER BY '{$type}' limit 1");
            if (!empty($where["string"])) {
                $this->bind(":" . $where["field"], $where["value"]);
            }
            $this->execute();
            return new JSON($this->fetch());
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    /**
     * @param Array $where - Asociative
     * ej:has(["iduser[>]" => 20])
     * return a boolean
     */
    public function has($where = null)
    {
        $response = false;
        $where = $this->whereToString($where);
        if (!isset($where["string"])) {
            $where["string"] = "";
        }
        try {
            $this->querye("SELECT * FROM {$this->table} {$where["string"]} limit 1");
            if (!empty($where["string"])) {
                $this->bind(":" . $where["field"], $where["value"]);
            }
            $this->execute();
            if ($this->rowCount() > 0) {
                $response = true;
            }
            return new JSON($response);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    /**
     * @param Array $where - Asociative
     * ej:count(["iduser[>]" => 20])
     * return a Int
     */
    public function count($where = null)
    {
        $response = false;
        $where = $this->whereToString($where);
        if (!isset($where["string"])) {
            $where["string"] = "";
        }
        try {
            $this->querye("SELECT * FROM {$this->table} {$where["string"]} ");
            if (!empty($where["string"])) {
                $this->bind(":" . $where["field"], $where["value"]);
            }
            $this->execute();

            return new JSON($this->rowCount());
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    /**
     * @param Array $data
     * Description: Array with key (column) and value to insert
     */
    public function insert($data)
    {
        try {
            $keys = array_keys($data);
            $columns = implode(",", $keys);
            $values = "";
            foreach ($keys as $column) {
                $values .= ":" . $column . ",";
            }
            $values = substr($values, 0, strlen($values) - 1);
            $this->querye("INSERT INTO {$this->table} ({$columns}) VALUES ($values)");

            foreach ($data as $field => $value) {
                $this->bind(":{$field}", $value);
            }
            $this->execute();
            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * @param Array $data - Asociative
     * @param Array $where - Asociative
     */
    public function update($data, $where)
    {
        $fieldDetail = "";
        try {
            $where = $this->whereToString($where);
            if (!isset($where["string"])) {
                return false;
            }
            if (intval($where["value"])) {
                $where["value"] = intval($where["value"]);
            }
            foreach ($data as $field => $value) {
                $fieldDetail .= $field . "= :" . $field . ",";
            }
            $fieldDetail = substr($fieldDetail, 0, -1);
            $this->querye("UPDATE {$this->table} SET {$fieldDetail} {$where["string"]}");
            foreach ($data as $field => $value) {
                $this->bind(":" . $field, $value);
            }
            if (!empty($where["string"])) {
                $this->bind(":" . $where["field"], $where["value"]);
            }
            $this->execute();
            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    /**
     * @param Array $where - Asociative
     * @param Array $limit : Only delete one register
     * ej: delete(["iduser[=]",1])
     */
    public function delete($where, $limit = 1)
    {
        try {
            $where = $this->whereToString($where);
            if (!isset($where["string"])) {
                return false;
            }
            if (intval($where["value"])) {
                $where["value"] = intval($where["value"]);
            }
            $this->querye("DELETE FROM {$this->table} {$where["string"]} limit {$limit}");
            $this->bind(":" . $where["field"], $where["value"]);
            return $this->execute();
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    /**
     * @param Array $where - Asociative
     * @param Array $limit : Only change os state one register
     * ej: disable(["iduser[=]",1])
     */
    public function disable($where, $limit = 1)
    {
        $fieldDetail = "";
        try {
            $where = $this->whereToString($where);
            if (!isset($where["string"])) {
                return false;
            }
            $fieldDetail = substr($fieldDetail, 0, -1);
            $this->querye("UPDATE {$this->table} SET status = 0 {$where["string"]} limit {$limit}");
            $this->bind(":" . $where["field"], $where["value"]);
            $this->execute();
            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     *  @param Array  $cond [column,value]
     *  @param Array $columns [column1,column2] -- Only two options
     *  @param String $string  [value] 
     *  @param Int $limit [limit] 
     */
    public function selectByCondLikeLimit($where, $columns, $string, $limit = 20)
    {
        try {
            $key = array_keys($where)[0];
            $value = $where[$key];
            $sql = "SELECT * FROM {$this->table} WHERE {$key} = :columnvalue AND ( {$columns[0]}  LIKE CONCAT('%',:like1,'%') OR  {$columns[1]} LIKE CONCAT('%',:like2,'%'))  limit {$limit}";
            $this->querye($sql);
            $this->bind(":columnvalue", $value);
            $this->bind(":like1", $string);
            $this->bind(":like2", $string);
            $this->execute();
            return new JSON($this->fetchAll());
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     *   @param  Array $columns [column1,column2] 
     *   @param  String $string [value] 
     *   @param  Int $limit [limit] 
     */
    public function selectByLikeLimit($columns, $string, $limit = 20)
    {
        try {

            $like = "";
            $cont = 0;
            foreach ($columns as $column) {
                $like .= "{$column} LIKE CONCAT('%',:{$column},'%')";
                isset($columns[++$cont]) ? $like .= " OR " : "";
            }
            (!empty($like)) ? $like = "WHERE " . $like : "";
            $this->querye("SELECT * FROM {$this->table} {$like}  limit {$limit}");
            foreach ($columns as $column) {
                $this->bind(":{$column}", $string);
            }
            $this->execute();
            return new JSON($this->fetchAll());
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     *   @param Any The same parameter of select ony add The name of the tables
     */
    public function selectByTable($table, $select = "*", $where = null, $limit = 20, $type = "asc")
    {
        try {
            $classTable = $this->table;
            $this->table = $table;
            $result =  $this->select($select, $where, $limit, $type);
            $this->table = $classTable;
            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     *   @param  String $column 
     *   @param  Array $where [value] 
     */
    public function max($column, $where)
    {
        try {
            $where = $this->whereToString($where);
            if (!isset($where["string"])) {
                $where["string"] = "";
            }
            $this->querye("SELECT max({$column}) as max from {$this->table} {$where["string"]}");
            if (!empty($where["string"])) {
                $this->bind(":" . $where["field"], $where["value"]);
            }
            $this->execute();
            return new JSON($this->fetch()->max);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     *   @param  String $column 
     *   @param  Array $where [value] 
     */
    public function min($column, $where)
    {
        try {
            $where = $this->whereToString($where);
            if (!isset($where["string"])) {
                $where["string"] = "";
            }
            $this->querye("SELECT min({$column}) as min from {$this->table} {$where["string"]}");
            if (!empty($where["string"])) {
                $this->bind(":" . $where["field"], $where["value"]);
            }
            $this->execute();
            return new JSON($this->fetch()->min);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     *   @param  String $column 
     *   @param  Array $where [value] 
     */
    public function sum($column, $where)
    {
        try {
            $where = $this->whereToString($where);
            if (!isset($where["string"])) {
                $where["string"] = "";
            }
            $this->querye("SELECT sum({$column}) as sum from {$this->table} {$where["string"]}");
            if (!empty($where["string"])) {
                $this->bind(":" . $where["field"], $where["value"]);
            }
            $this->execute();
            return new JSON($this->fetch()->sum);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     *   @param  String $column 
     *   @param  Array $where [value] 
     */
    public function avg($column, $where)
    {
        try {
            $where = $this->whereToString($where);
            if (!isset($where["string"])) {
                $where["string"] = "";
            }
            $this->querye("SELECT avg({$column}) as avg from {$this->table} {$where["string"]}");
            if (!empty($where["string"])) {
                $this->bind(":" . $where["field"], $where["value"]);
            }
            $this->execute();
            return new JSON($this->fetch()->avg);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function hasByTable($table, $where)
    {
        try {
            $classTable = $this->table;
            $this->table = $table;
            $result =  $this->has($where);
            $this->table = $classTable;
            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }




    // Methods privates

    private function whereToString($where)
    {
        $string = "";
        if (!is_null($where)) {
            $key = array_keys($where)[0];
            $sign = substr($key, strpos($key, "[") + 1, -1);
            $column = str_replace(substr($key, strpos($key, "[")), "", $key);
            $string = "WHERE {$column} {$sign} :{$column}";
            return ["field" => $column, "value" => $where[$key], "string" => $string];
        }
        return null;
    }
}
