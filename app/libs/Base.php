<?php
class Base extends PDO
{
    private $dbhost = DBHOST;
    private $dbname = DBNAME;
    private $dbuser = DBUSER;
    private $dbpassword = DBPASWORD;
    private $dbdriver = DBDRIVER;
    private $dbcharset = DBCHARSET;

    private $dsn = "";
    private $options = [];
    private $stmt;

    protected function __construct()
    {
        $this->dsn = "{$this->dbdriver}:host={$this->dbhost};dbname={$this->dbname};charset={$this->dbcharset}";
        $this->options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ];
        try {
            parent::__construct($this->dsn, $this->dbuser, $this->dbpassword, $this->options);
        } catch (PDOException $e) {
            exit("Error al conectarse a la Base de datos! {$e->getMessage()}");
        }
    }

    protected function querye($query)
    {
        $this->stmt = $this->prepare($query);
    }

    protected function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch ($value) {
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default;
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        return $this->stmt->bindParam($param, $value, $type);
    }

    protected function execute()
    {
        return $this->stmt->execute();
    }

    protected function fetch()
    {
        return $this->stmt->fetch();
    }

    protected function fetchAll()
    {
        return $this->stmt->fetchAll();
    }

    protected function rowCount()
    {
        return $this->stmt->rowCount();
    }

    protected function columnCount()
    {
        return $this->stmt->rowCount();
    }

}
