<?php

namespace App\Http\Controllers\Event;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Models\EventModality;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('events.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modalities = EventModality::all();
        $categories = EventCategory::all();

        return view('events.event', compact('modalities', 'categories'));
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
            'name'=>'required',
            'date_event'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'adress'=>'required',
            'modality_id'=>'required',
            'category'=>'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $inputs = [
            'name' => $request->input('name'),
            'date_event' => $request->input('date_event'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'adress' => $request->input('adress'),
            'modality_id' => $request->input('modality_id'),
            'logo' => time().'.'.$request->logo->getClientOriginalExtension(),
        ];

        try {
            $event = Event::create($inputs);
            $request->logo->move(public_path('storage/logo_events'), $inputs['logo']);
            $event->categories()->sync($request->input('category'));

            return back()->with('success','Evento Criado com sucesso');
        } catch (\Throwable $th) {
            return back()->with('error','Erro ao cadastrar');

            //throw $th;
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
        $event = Event::find($id);

        return view('events.event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        //
    }
}
