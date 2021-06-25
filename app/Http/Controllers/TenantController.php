<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\User;
use App\Models\Tenant;
use App\Models\TenantNotifyJoinUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

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
        $tenant = Tenant::find($id);

        return view('tenants.edit', compact('tenant'));
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
        $tenant = Tenant::find($id);

        try {
            //code...
            $tenant->update($request->all());
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect('user/profile');
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

    public function create_notify_joingroup(Request $request)
    {
        $tenant = Tenant::find($request->all_tenants);
        $recipient_users = $tenant->users;
        
        foreach($recipient_users as $recipient_user) {
            
            TenantNotifyJoinUser::create([
                'requesting_user_id' => Auth::id(),
                'tenant_id' => $tenant->id,
                'recipient_users' => $recipient_user->id
            ]);

        }

        return redirect('user/profile')->with('success', 'Solicitação enviada ao grupo! Aguarde até que algum membro do grupo aprove a sua solicitação.');
    }

    public function joinGroup($tenant_id, $user_id, $notify_id) {

        try {
            DB::beginTransaction();

            $tenant = Tenant::find($tenant_id);
            $user = User::find($user_id);
            $notify = TenantNotifyJoinUser::find($notify_id);

            if(count($user->tenants()->where('tenant_id', $tenant)->get()) <= 0) {
                $tenant->users()->attach($user);
            } else {
                DB::rollBack();
                return back()->with('error', "O usuário já percence a este grupo!");
            }
            
            $notify->delete(); //Apaga notificaçao atendida
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return back()->with('error', "Erro ao inserir usuário!");

        }
        return back()->with('success', "Usuário aceito!");
    }
}
