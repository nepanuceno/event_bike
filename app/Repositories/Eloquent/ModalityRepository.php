<?php
namespace App\Repositories\Eloquent;

use App\Models\EventModality;
use App\Repositories\Contracts\ModalityRepositoryInterface;


class ModalityRepository extends AbstractRepository implements ModalityRepositoryInterface
{
    protected $model = EventModality::class;

}
