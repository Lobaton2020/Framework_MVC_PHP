<?php

class MainController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = $this->model("link");
    }

    public function index()
    {

        $links = $this->model->all();
        return view("main.index", ["links" => $links]);
    }

    public function edit($id = null)
    {
        $link = $this->model->get($id);
        return view("main.update", ["link" => $link]);
    }

    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                "id" => trim($_POST["id"]),
                "titulo" => trim($_POST["titulo"]),
                "url_link" => trim($_POST["id"])
            ];
            if ($this->model->update($data)) {
                redirect("main");
            } else {
                redirect("main");
            }
        } else {
            exit("Error de metodo de peticion");
        }
    }

    public function delete($id = null)
    {
        d($id);
    }
}
