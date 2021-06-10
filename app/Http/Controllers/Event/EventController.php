<?php

namespace App\Http\Controllers\Event;

use DateTime;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventImages;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Models\EventModality;
use App\Models\CategoryHasEvent;
use Illuminate\Support\Facades\DB;
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
        $events = Event::where('active','<>', 0)->get();

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

        return view('events.event.create_event', compact('modalities', 'categories'));
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
            'description'=>'required',
            'date_event'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'adress'=>'required',
            'modality_id'=>'required',
            'category'=>'required',
            'event_notice' => 'required|file|mimes:pdf|max:1024',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $date_event = Carbon::createFromFormat('d/m/Y, H:i:s', $request->input('date_event'))->format('Y-m-d H:i:s');
        $start_date = Carbon::createFromFormat('d/m/Y, H:i:s', $request->input('start_date'))->format('Y-m-d H:i:s');
        $end_date = Carbon::createFromFormat('d/m/Y, H:i:s', $request->input('end_date'))->format('Y-m-d H:i:s');

        $inputs = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'date_event' => $date_event,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'adress' => $request->input('adress'),
            'modality_id' => $request->input('modality_id'),
            'event_notice' => 'notice_'.time().'.'.$request->event_notice->getClientOriginalExtension(),
            'logo' => time().'.'.$request->logo->getClientOriginalExtension(),
        ];

        try {
            $event = Event::create($inputs);
            $request->event_notice->move(public_path('storage/event_notices'), $inputs['event_notice']);
            $request->logo->move(public_path('storage/logo_events'), $inputs['logo']);
            $event->categories()->sync($request->input('category'));

            return back()->with('success','Evento Criado com sucesso');
        } catch (\Throwable $th) {
            //return back()->with('error','Erro ao cadastrar');

            throw $th;
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
        $event = Event::find($id);
        $modalities = EventModality::all();
        $categories = EventCategory::all();

        //Modificando as datas vindas do banco para o formato pt-br
        $date_event = Carbon::createFromFormat('Y-m-d H:i:s', $event->date_event)->format('d/m/Y H:i:s');
        $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('d/m/Y H:i:s');
        $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $event->end_date)->format('d/m/Y H:i:s');

        $event->date_event = $date_event;
        $event->start_date = $start_date;
        $event->end_date = $end_date;

        // dd($event->date_event);
        return view('events.event.edit_event', compact('event','modalities','categories'));
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
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'date_event'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'adress'=>'required',
            'modality_id'=>'required',
            'category'=>'required',
            'event_notice' => 'file|mimes:pdf|max:1024',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $date_event = Carbon::createFromFormat('d/m/Y, H:i:s', $request->input('date_event'))->format('Y-m-d H:i:s');
        $start_date = Carbon::createFromFormat('d/m/Y, H:i:s', $request->input('start_date'))->format('Y-m-d H:i:s');
        $end_date = Carbon::createFromFormat('d/m/Y, H:i:s', $request->input('end_date'))->format('Y-m-d H:i:s');

        $inputs = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'date_event' =>  $date_event,
            'start_date' => $start_date ,
            'end_date' =>  $end_date,
            'adress' => $request->input('adress'),
            'modality_id' => $request->input('modality_id'),
        ];

        $event = Event::find($id);

        if($request->hasFile('event_notice')) {
            $inputs['event_notice']='notice_'.time().'.'.$request->event_notice->getClientOriginalExtension();
            $old_event_notice = $event->event_notice;
        }

        if($request->hasFile('logo')) {
            $inputs['logo']=time().'.'.$request->logo->getClientOriginalExtension();
            $old_logo = $event->logo;
        }

        try {
            if($event->update($inputs)) {
                $event->categories()->sync($request->input('category'));

                if(isset($old_event_notice)) {

                    if(file_exists('storage/event_notices/'.$old_event_notice)) {
                        unlink('storage/event_notices/'.$old_event_notice);
                    }

                    $request->event_notice->move(public_path('storage/event_notices'), $inputs['event_notice']);
                }

                if(isset($old_logo)) {

                    if(file_exists('storage/logo_events/'.$event->logo)) {
                        unlink('storage/logo_events/'.$event->logo);
                    }
                    $request->logo->move(public_path('storage/logo_events'), $inputs['logo']);
                }

                return redirect()->route('event.index')->with('success',"Evento atualizado com sucesso!");
            }
        } catch (\Throwable $th) {
            throw $th;

            return redirect()->back()->with('error',"Houve problema ao atualizar o evento ".$event->name.PHP_EOL.$th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->active = false;
        $event->save();

        return redirect()->back()->with('success',"Evento desativado com sucesso");
    }

    //Publish photos from the image gallery of an event
    public function upload(Request $request, $id)
    {
        $name_file = $request->file->getClientOriginalName();
        $event = Event::find($id);
        $image_event = new EventImages;
        $image_name = md5($name_file).'.'.$request->file->getClientOriginalExtension();
        $image_event->event_id = $id;
        $image_event->image = $image_name;


        if($image_event->save()){
            $request->file->move(public_path('storage/event_images'), $image_name);
        } else {
            echo "Errou feio";
        }
    }

    public function add_costs(Request $request)
    {
        $inputs=$request->all();
        foreach($inputs as $key=>$input) {
            if ($key != "_token" && $key!="event_id") {
                $arr[$key] = $input;
            }
        }

        foreach($arr as $key=>$value) {
            $cost = DB::update('update category_has_event SET cost = ? WHERE event_id = ? AND category_id = ?', [$value, $inputs['event_id'], $key]);
            if(!$cost) {
                return back()->with('error', 'Erro ao tentar setar um valor.');
            }
        }

        return back()->with('success', 'Valor adicionado com sucesso!');
    }

    public function published_events()
    {
        $events = Event::all();

        return view('welcome', compact('events'));
    }
}
