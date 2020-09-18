<?php

class Link
{
    private $base;

    public function __construct()
    {
        $this->base = Base::connect();
    }

    public function all()
    {
        return $this->base->query("SELECT * FROM Link limit 20")->fetchAll();
    }
    public function get($id)
    {
        $stmt =  $this->base->prepare("SELECT * FROM Link WHERE id_link_PK = :id_link_PK");
        $stmt->bindValue(":id_link_PK", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function update($data)
    {
        $stmt =  $this->base->prepare("UPDATE Link SET titulo = :titulo , url_link = :url_link WHERE id_link_PK = :id_link_PK");
        $stmt->bindValue(":titulo", $data["titulo"]);
        $stmt->bindValue(":url_link", $data["url_link"]);
        $stmt->bindValue(":id_link_PK", $data["id"]);

        return $stmt->execute();
    }
}
