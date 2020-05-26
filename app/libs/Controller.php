<?php

class Controller extends Authentication
{
    protected function __construct()
    {
        parent::__construct();
    }

    private function httpResponseError()
    {
        return ["http" => [
            "description" => "Error, source not found, Access denied",
            "state" => 404,
            "type" => "Error",
            "suggest" => "try do loggin",
        ]];
    }
    protected function httpResponse()
    {
        return [
            "state" => 200,
            "type" => "success",
        ];
    }

    protected function verify_authentication($type = "PRIMARY_AUTHENTICATION")
    {
        switch ($type) {
            case "PRIMARY_AUTHENTICATION":
                if (!$this->checkSession()) {
                    $this->redirect("auth");
                    // echo json_encode($this->httpResponseError());
                    exit();
                }
                break;
            case "SECONDARY_AUTHENTICATION":
                if ($this->checkSession()) {
                    $this->redirect("main");
                    exit();
                }
                break;
            default;
                exit("Error param. Verify Authentication");
        }

    }

    protected function model($model)
    {
        $model = ucwords($model) . "Model";
        if (file_exists("../app/models/" . $model . ".php")) {
            require_once "../app/models/" . $model . ".php";
            return new $model();
        } else {
            exit("Modelo no encontrado");
        }
    }

    protected function entity($entity)
    {

        $model = ucwords($entity);
        if (file_exists("../app/models/entities/" . $entity . ".php")) {
            require_once "../app/models/entities/" . $entity . ".php";
            return new $entity();
        } else {
            exit("Entidad o VO no encontrado");
        }
    }

    protected function view($view, $params = [])
    {
        if (file_exists("../app/views/pages/" . $view . ".php")) {
            require_once "../app/views/pages/" . $view . ".php";
        } else {
            exit("Vista no encontrada");
        }
    }

    protected function redirect($path)
    {
        echo "<script>window.location.href = '" . URL_PROJECT . $path . "'</script>";
    }

}
