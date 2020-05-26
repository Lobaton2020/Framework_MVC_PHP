<?php

// entiti de ejemplo
class User
{
    private $iduser;
    private $idrole;
    private $name;
    private $lastname;
    private $email;
    private $nickname;
    private $password;
    private $state;
    private $birthday;
    private $createdate;

    public function getIdUser()
    {
        return $this->iduser;
    }
    public function getIdRole()
    {
        return $this->idrole;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getLastName()
    {
        return $this->lastname;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getNickname()
    {
        return $this->nickname;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getState()
    {
        return $this->state;
    }
    public function getBirthday()
    {
        return $this->birthday;
    }
    public function getCreateDate()
    {
        return $this->createdate;
    }

    // setters

    public function setIdUser($iduser)
    {
        $this->iduser = $iduser;
    }
    public function setIdRole($idrole)
    {
        $this->idrole = $idrole;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setLastName($lastname)
    {
        $this->lastname = $lastname;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setState($state)
    {
        $this->state = $state;
    }
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }
    public function setCreateDate($createdate)
    {
        $this->createdate = $createdate;
    }

}
