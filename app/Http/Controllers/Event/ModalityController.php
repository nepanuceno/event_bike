<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use App\Models\EventModality;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ModalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modalities = EventModality::all();

        return view('events.modality.index', compact('modalities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.modality.create_modality');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);

        try {
            EventModality::create(['name'=>$request->input('name')]);
            return redirect()->route('modality.index')->with('success',__('modalities.created_successfully').'!');
        } catch (\Throwable $th) {
            return redirect()->route('modality.index')->with('error',__('modalities.error_creating_modality').'! '.$th);
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
        $modality = EventModality::find($id);
        return view('events.modality.edit_modality', compact('modality'));
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
        $this->validate($request, [
            'name' => 'required',
        ]);

        try {
            $modality = EventModality::find($id);

            $modality->name = $request->input('name');
            $modality->save();

            return redirect()->route('modality.index')->with('success', __('modalities.successfully_updated'));
        } catch (\Throwable $th) {
            return redirect()->route('modality.index')->with('error', __('modalities.problem_updating').'! '.$th);
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
        DB::table("event_modalities")->where('id',$id)->delete();
        return redirect()->route('modality.index')
            ->with('success',__('modalities.successfully_deleted').'!');
    }
}
