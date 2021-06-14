<?php
namespace App\Repositories\Contracts;


interface ModalityRepositoryInterface
{
    public function all();

    public function find($id);

    public function create($array_inputs);

    public function where(...$params);
}
