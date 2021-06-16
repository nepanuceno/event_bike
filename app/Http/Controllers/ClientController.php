<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    public function index()
    {
        $events = Event::all();

        return view('clients.welcome', compact('events'));
    }
}
