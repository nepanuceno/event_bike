<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    private $user;

    function __construct()
    {
        // $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','store']]);
        // $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        // $this->middleware('permission:manager', ['only' => ['index','edit','update']]);
        // $this->middleware('permission:manager', ['only' => ['destroy']]);
        $this->middleware('permission:manager');
        $this->user = User::find(Auth::id());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $inputs = [
                'name'=> $request->name,
                'creator_user_id' => Auth::id(),
                'key_pagarme'=> isset($request->key_pagarme) ? $request->key_pagarme : null,
            ];

            $tenant = Tenant::create($inputs);
            // dd($request);

            $tenant->users()->sync(Auth::id());
            DB::commit();
            
            return redirect()->route('profile')->with('success', "Grupo criado com sucesso!");
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
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
        $tenant = Tenant::find($id);
        return view('tenants.show', compact('tenant'));
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
        //
    }

    public function choices()
    {
        $user = Auth::user();
        $tenants = $user->tenant;
        return view('tenants.choices-tenants', compact('tenants'));
    }

    public function setTenantId($id)
    {
        session(['tenant_id' => $id]);
        return redirect('home');
    }
}
