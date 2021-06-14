<?php
namespace App\Repositories\Eloquent;

use App\Models\CategoryHasEvent;
use App\Repositories\Contracts\CategoryHasEventRepositoryInterface;


class CategoryHasEventRepository extends AbstractRepository implements CategoryHasEventRepositoryInterface
{
    protected $model = CategoryHasEvent::class;

}
