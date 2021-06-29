<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventSubscribeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients.event_subscribe');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'event'=> 'required',
            'select_category' => 'required',
        ]);

        // dd($request);

        $subscribe = new EventUser();

        $subscribe_status = $subscribe->where('user_id', Auth::id())
            ->where('event_id',$request->event)->get();

        if(count($subscribe_status) == 0)
        {
            $subscribe->create([
                'user_id' => Auth::id(),
                'event_id'=>$request->event,
                'category_id' => $request->select_category,
            ]);

            return redirect()->route('welcome')->with('success', 'Parabéns!');
        } else {
            return redirect()->route('welcome')->with('error', 'Você já está inscrito neste Evento!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $event = Event::find($id);

        $enrolled = EventUser::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->first();

        $enrolled->delete();

        return redirect()->route('welcome')->with('success', 'Sua inscrição foi cancela!');
    }
}
