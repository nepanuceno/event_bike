<?php
namespace App\Repositories\Eloquent;

abstract class AbstractRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create($array_inputs)
    {
        return $this->model->create($array_inputs);
    }

    public function where(...$params)
    {
        if(count($params) == 2) {
            return $this->model->where($params[0], $params[1]);
        } else {
            return $this->model->where($params[0], $params[1], $params[2]);
        }
    }

}
