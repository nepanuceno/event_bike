<?php
namespace App\Repositories\Contracts;


interface CategoryHasEventRepositoryInterface
{
    public function all();

    public function find();

    public function create($array_inputs);

    public function where(...$params);
}
