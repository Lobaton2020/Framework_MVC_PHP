<?php

class UserController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        // $this->authentication();
        $this->model = $this->model("user");
    }

    public function index()
    {
        // return dd($this->model->select()->array());
        return view("auth.login");
        // echo "Hola Mundo!";
        // echo "<a href=" . route("auth/login") . ">Iniciar Session</a>";
    }


    public function get($id = null)
    {
        return dd($this->model->get("*", ["iduser[=]" => $id])->array());
    }
    public function count()
    {
        return dd($this->model->count(["name[=]" => 0])->array());
    }
    public function sum()
    {
        return dd($this->model->sum("iduser", ["name[=]" => 2])->array());
    }
    public function avg()
    {
        return dd($this->model->avg("iduser", ["name[=]" => 2])->array());
    }
    public function min()
    {
        return dd($this->model->min("iduser", ["name[=]" => 2])->array());
    }
    public function max()
    {
        return dd($this->model->max("iduser", ["name[=]" => 2])->array());
    }
    // Receive data for methos post
    public function store()
    {
        execute_post(function ($request) {

            $insert = [
                "idrol" => $request->idrol,
                "name" => $request->name,
                "lastname" => $request->lastname,
                "email" => $request->email,
                "nickname" => $request->nickname,
                "password" => encrypt(123456789),
                "status" => 1,
                "create_date" => getCurrentDatetime()
            ];
            if ($this->model->insert($insert)) {
                echo "OK";
            } else {
                echo "ERROR";
            }
        });
    }
    public function update()
    {
        execute_post(function ($request) {

            $insert = [
                "lastname" => $request->lastname,

            ];
            if ($this->model->update($insert, ["iduser[=]" => 3])) {
                echo "OK";
            } else {
                echo "ERROR";
            }
        });
    }


    public function delete()
    {
        execute_post(function ($request) {

            if ($this->model->delete(["iduser[=]" => $request->id])) {
                echo "OK";
            } else {
                echo "ERROR";
            }
        });
    }

    public function disable()
    {
        execute_post(function ($request) {

            if ($this->model->disable(["iduser[=]" => $request->id])) {
                echo "OK";
            } else {
                echo "ERROR";
            }
        });
    }
}
