<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $events = $this->event->where('active','<>', 0)
        ->whereDate('date_event','>',date(Carbon::now()->toDateString()))
        ->whereDate('end_date','>',date(Carbon::now()->toDateString()))
        ->get();

        $events = $this->status_event($events);
        $id=0;
        return view('clients.welcome', compact('events','id'));
    }

    public function status_event($events){
        foreach($events as $event) {

            $now = Carbon::createFromFormat('Y-m-d', date(Carbon::now()->toDateString()));
            $date_event = Carbon::createFromFormat('Y-m-d H:i:s', $event->date_event);
            $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date);
            $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $event->end_date);


            if($start_date->gt($now)){
                $event['status'] = 1; //New
            } else if($now->gte($start_date) && ($now->lte($end_date))) {
                $event['status'] = 2; //Open Subscription
            } else if($now->gte($end_date)) {
                $event['status'] = 3; //End Subscription
            }

            if(Auth::check()) {
                // dd(Auth::user()->events_subscribe);
                foreach(Auth::user()->events_subscribe as $event_subscribed) {
                    if($event->id == $event_subscribed->id)
                    {
                        $event['subscribe'] = true;
                    }
                }
            }
        }

        return $events;
    }

    public function filter_events(Request $request)
    {
        $id = $request->filter;

        switch($id)
        {
            case 1 : $events = $this->event->where('active','<>', 0)
                    ->whereDate('date_event','>',date(Carbon::now()->toDateString()))
                    ->whereDate('end_date','>',date(Carbon::now()->toDateString()))
                    ->get();
                break;

            case 2 : $events = $this->event->where('active','<>', 0)
                    ->where('start_date','>',date(Carbon::now()->toDateString()))->get();
                break;

            case 3 : $events = $this->event->where('active','<>', 0)
                    ->where('date_event','>',date(Carbon::now()->toDateString()))
                    ->where('start_date','<',date(Carbon::now()->toDateString()))
                    ->where('end_date','>',date(Carbon::now()->toDateString()))
                    ->get();
                break;

            case 4 : $events = $this->event->where('active','<>', 0)
                    ->where('date_event','>',date(Carbon::now()->toDateString()))
                    ->where('end_date','<',date(Carbon::now()->toDateString()))
                    ->get();
                break;
        }

        $events = $this->status_event($events);
        return view('clients.welcome', compact('events','id'));
    }
}
