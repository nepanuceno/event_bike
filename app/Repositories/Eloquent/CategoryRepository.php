<?php
namespace App\Repositories\Eloquent;

use App\Models\EventCategory;
use App\Repositories\Contracts\CategoryRepositoryInterface;


class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    protected $model = EventCategory::class;

}
