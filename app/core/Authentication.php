<?php

class Authentication
{
    private $checkSession = false;

    protected function __construct()
    {
        session_start();
        if (isset($_SESSION["activeSession"]) && isset($_SESSION["user_data_credentials"])) {
            if ($_SESSION["activeSession"] == true) {
                $this->checkSession = true;
            }
        }
    }

    protected function checkSession()
    {
        return $this->checkSession;
    }

    protected function getSession()
    {
        return $_SESSION;
    }

    protected function setSession($datauser)
    {
        try {
            if ($_SESSION["user_data_credentials"] = $datauser) {
                $_SESSION["activeSession"] = true;
            }
            return true;
        } catch (Exception $e) {
            exit("Error " . $e->getMessage());
        }

    }

    protected function destroySession()
    {
        try {
            $_SESSION["user_data_credentials"] = null;
            $_SESSION["activeSession"] = false;
            session_destroy();
            return true;
        } catch (Exception $e) {
            exit("Error " . $e->getMessage());
        }
    }

}
