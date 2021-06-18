<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\EventRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ModalityRepositoryInterface;
use App\Repositories\Contracts\CategoryHasEventRepositoryInterface;

class ClientController extends Controller
{
    public $events;
    public $modality;
    public $category;
    public $categoryHasEvent;

    public function __construct(
        EventRepositoryInterface $events, ModalityRepositoryInterface $modality, CategoryRepositoryInterface $category, CategoryHasEventRepositoryInterface $categoryHasEvent)
    {
        $this->event = $events;
        $this->modality = $modality;
        $this->category = $category;
        $this->categoryHasEvent = $categoryHasEvent;
    }


    public function index()
    {
        // $events = Event::all();
        $events = $this->event->where('active','<>', 0)
        ->whereDate('date_event','>',date(Carbon::now()->toDateString()))
        ->whereDate('end_date','>',date(Carbon::now()->toDateString()))
        ->get();

        return view('clients.welcome', compact('events'));
    }
}
