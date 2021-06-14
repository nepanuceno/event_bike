<?php
namespace App\Repositories\Eloquent;

use App\Models\EventModality;
use App\Repositories\Contracts\CategoryHasEventRepositoryInterface;


class CategoryHasEventRepository extends AbstractRepository implements CategoryHasEventRepositoryInterface
{
    protected $model = EventModality::class;

}
