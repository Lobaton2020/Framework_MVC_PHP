<?php

class MainController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->autentication();
        $this->model = $this->model("link");
    }

    public function logout()
    {
        unset($_SESSION["credentials"]);
        redirect("auth");
    }

    public function index()
    {
        $links = $this->model->select();
        return view("main.index", ["links" => $links]);
    }
    public function create()
    {
        return view("main.create");
    }
    public function edit($id = null)
    {
        $link = $this->model->get($id);
        return view("main.update", ["link" => $link]);
    }

    public function store()
    {
        execute_post(function ($request) {
            $data = [
                "id_usuario_FK" => 1,
                "titulo" => trim($request->titulo),
                "url_link" => trim($request->url_link),
                "fecha_ingreso" => currentDatetime()
            ];
            if ($this->model->insert($data)) {
                redirect("main")->with("info", "El link se creo");
            } else {
                redirect("main")->with("error", "El link no se creo");
            }
        });
    }

    public function update()
    {
        execute_post(function ($request) {
            $data = [
                "titulo" => trim($request->titulo),
                "url_link" => trim($request->url_link),
                "id" => trim($request->id)
            ];
            if ($this->model->update($data)) {
                redirect("main")->with("info", "El link se actualizo");
            } else {
                redirect("main")->with("error", "El link no se actualizo");
            }
        });
    }

    public function delete($id = null)
    {
        if ($this->model->delete($id)) {
            redirect()->with("info", "El link se eliminó");
        } else {
            redirect()->with("error", "El link no se eliminó");
        }
    }
}
