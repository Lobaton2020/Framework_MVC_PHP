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

    protected function authentication($type = "PRIMARY")
    {
        switch ($type) {
            case "PRIMARY":
                if (!$this->checkSession()) {
                    $this->redirect("auth");
                    // echo json_encode($this->httpResponseError());
                    exit();
                }
                break;
            case "SECONDARY":
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
        $model = ucwords($model);
        $modelPath =  URL_APP . "models" . SEPARATOR . $model . ".php";
        if (file_exists($modelPath)) {
            require_once $modelPath;
            if (class_exists($model)) {
                return new $model();
            } else {
                exit("Class of model not found");
            }
        } else {
            exit("Model not found");
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
