<?php

namespace App\Http\Controllers\Event;

use DateTime;
use Carbon\Carbon;
use App\Models\EventImages;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Models\EventModality;
use App\Models\CategoryHasEvent;
use App\Http\Controllers\Controller;
use App\Models\EventVideos;
use App\Repositories\Contracts\CategoryHasEventRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\EventRepositoryInterface;
use App\Repositories\Contracts\ModalityRepositoryInterface;

class EventController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->event_filter(1);

        if(count($result) == 0) {
            return view('events.event.index', ['events'=>$result['all'], 'event_queries'=>$result, 'status'=>1 ])
            ->with('empty', "Não ha resultados para esta consulta");
        }
        return view('events.event.index', ['events'=>$result['all'], 'event_queries'=>$result, 'status'=>1 ]);
    }

    //Performs event queries separating by status
    public function event_queries($events)
    {
        $all = clone $events;
        $all = $all->get();

        $released_events = clone $events;
        $released_events = $released_events->whereDate('start_date','>',date(Carbon::now()->toDateString()))
            ->get();

        $open_subscriptions = clone $events;
        $open_subscriptions = $open_subscriptions->whereDate('date_event','>',date(Carbon::now()->toDateString()))
            ->whereDate('start_date','<',date(Carbon::now()->toDateString()))
            ->whereDate('end_date','>',date(Carbon::now()->toDateString()))
            ->get();

        $closed_subscriptions = clone $events;
        $closed_subscriptions = $closed_subscriptions->whereDate('date_event','>',date(Carbon::now()->toDateString()))
            ->whereDate('end_date','<',date(Carbon::now()->toDateString()))
            ->get();

        $past_events = clone $events;
        $past_events = $past_events->whereDate('date_event','<',date(Carbon::now()->toDateString()))
            ->get();

        $disabled_events = $this->event->where('active', 0)->get();

        return compact('all','released_events', 'open_subscriptions', 'closed_subscriptions', 'past_events', 'disabled_events');
    }

    //Filters events based on dates
    public function event_filter($id)
    {
        $events = $this->event->where('active','<>', 0);

        $event_queries = $this->event_queries($events);

        switch($id)
        {
            case 1 : return $events = $event_queries;
                break;
            case 2 : $events = $event_queries['released_events'];
                break;
            case 3 : $events = $event_queries['open_subscriptions'];
                break;
            case 4 : $events = $event_queries['closed_subscriptions'];
                break;
            case 5 : $events = $event_queries['past_events'];
                break;
            case 6 : $events = $event_queries['disabled_events'];
                break;
        }

        $status = $id;
        if(count($events) == 0) {
            return view('events.event.index', compact('events','event_queries', 'status'))->with('empty', "Não ha resultados para esta consulta");
        }

        return view('events.event.index', compact('events','event_queries', 'status'));
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

        // $date_event = Carbon::createFromFormat('d/m/Y, H:i:s', $request->input('date_event'))->format('Y-m-d H:i:s');
        // $start_date = Carbon::createFromFormat('d/m/Y, H:i:s', $request->input('start_date'))->format('Y-m-d H:i:s');
        // $end_date = Carbon::createFromFormat('d/m/Y, H:i:s', $request->input('end_date'))->format('Y-m-d H:i:s');

        $date_event = $this->dateFormatToDb($request->input('date_event'));
        $start_date = $this->dateFormatToDb($request->input('start_date'));
        $end_date = $this->dateFormatToDb($request->input('end_date'));


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
            $event = $this->event->create($inputs);
            $request->event_notice->move(public_path('storage/event_notices'), $inputs['event_notice']);
            $request->logo->move(public_path('storage/logo_events'), $inputs['logo']);
            $event->categories()->sync($request->input('category'));
            $event->categories()->sync(session()->get('tenant_id'));

            return back()->with('success','Evento Criado com sucesso');
        } catch (\Throwable $th) {
            return back()->with('error','Erro ao cadastrar');

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
        $event = $this->event->find($id);

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
        $event = $this->event->find($id);
        $modalities = $this->modality->all();
        $categories = $this->category->all();

        //Modificando as datas vindas do banco para o formato pt-br
        $event->date_event = $this->dateFormatToPt_BR( $event->date_event);
        $event->start_date = $this->dateFormatToPt_BR($event->start_date);
        $event->end_date = $this->dateFormatToPt_BR($event->end_date);

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

        $inputs = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'date_event' => $this->dateFormatToDb($request->input('date_event')),
            'start_date' => $this->dateFormatToDb($request->input('start_date')),
            'end_date' => $this->dateFormatToDb($request->input('end_date')),
            'adress' => $request->input('adress'),
            'modality_id' => $request->input('modality_id'),
        ];

        $event = $this->event->find($id);

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
        $event = $this->event->find($id);
        if($event->active == 1){
            $event->active = false;
            $status = 'Desativado';
        }
        else{
            $event->active = true;
            $status = 'Reativado';
        }
        $event->save();

        return redirect()->back()->with('success',"Evento ".$status." com sucesso");
    }

    //Publish photos from the image gallery of an event
    public function upload(Request $request, $id)
    {
        $name_file = $request->file->getClientOriginalName();
        $event = $this->event->find($id);
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

    //Add entry fees by category type
    public function add_costs(Request $request)
    {
        $inputs=$request->all();
        foreach($inputs as $key=>$input) {
            if ($key != "_token" && $key!="event_id") {
                $aux = str_replace(['.', 'R$ '], '', $input);
                $aux = str_replace(',','.',$aux);
                $arr[$key] = $aux;
            }
        }

        foreach($arr as $key=>$value) {
            try {
                $this->categoryHasEvent->where('event_id',$inputs['event_id'])
                    ->where('category_id', $key)
                    ->update(['cost'=> $value]);
            } catch (\Throwable $th) {
                // throw $th;
                return back()->with('error', 'Erro ao tentar setar um valor. '.$th);
            }
        }

        return back()->with('success', 'Valor adicionado com sucesso!');
    }


    public function csv_head_file()
    {
        ini_set('auto_detect_line_endings',TRUE);
        $handle = fopen('file.csv','r');
        $csv_head = fgetcsv($handle);
        return view('events.event.import_csv', compact('csv_head'));
    }

    private function dateFormatToDb($date_input)
    {
        $dateTime = Carbon::createFromFormat('d/m/Y, H:i:s', $date_input)->toDateTimeString();
        return $dateTime;
    }

    private function dateFormatToPt_BR($date_input)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date_input)->format('d/m/Y H:i:s');

    }

    public function create_video(Request $request)
    {
        // dd($request->all());

        try {
            EventVideos::create([
                'event_id' => $request->event_id,
                'url_video' => $request->url_video,
            ]);

            return redirect()->back()->with('success',"Vídeo cadastrado!");
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with('error',"Vídeo não cadastrado! ".$th);

        }
    }

    public function remove_video($id)
    {
        $video = EventVideos::find($id);

        $video->delete();

        return redirect()->back()->with('success','Vídeo removido!');
    }
}
