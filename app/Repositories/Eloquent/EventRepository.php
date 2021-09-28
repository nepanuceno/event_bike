<?php
namespace App\Repositories\Eloquent;

use App\Models\Event;
use App\Repositories\Contracts\EventRepositoryInterface;


class EventRepository extends AbstractRepository implements EventRepositoryInterface
{
    protected $model = Event::class;

}
