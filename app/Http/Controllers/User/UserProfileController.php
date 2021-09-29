<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
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
        $user = User::find(Auth::id());

        //Remove as Tenants ja solicitadas para entrada
        $notifies = $user->notifies;
        $requested_tenants = new Collection();
        foreach($notifies as $notify) {
            $requested_tenants = $requested_tenants->merge($notify->tenants);
        }
        //

        $all_tenants = Tenant::all();
        $tenants = $user->tenant;
        $profile = $user->profile;
        $addresses = $user->addresses;

        $all_tenants = $all_tenants->diff($tenants);
        $all_tenants = $all_tenants->diff($requested_tenants);
        $all_tenants = $all_tenants->all();

        return view('users.profile', compact('user', 'tenants', 'profile', 'addresses', 'all_tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.profile_create');
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
    		'rg' => 'required',
    		'cpf' => 'required|unique:profiles',
    		'phone' => 'required',
    		'emergency_phone' => 'required',
    		'blood_type' => 'required',
    		'gender' => 'required',
    		'allergy' => 'required',
    		'health_problem' => 'required',
    		'take_medication' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $input['photo'] = time().'.'.$request->photo->getClientOriginalExtension();
        $input['rg'] = $request->rg;
        $input['cpf'] = $request->cpf;
        $input['phone'] = $request->phone;
        $input['emergency_phone'] = $request->emergency_phone;
        $input['blood_type'] = $request->blood_type;
        $input['gender'] = $request->gender;
        $input['allergy'] = $request->allergy;
        $input['health_problem'] = $request->health_problem;
        $input['take_medication'] = $request->take_medication;
        $input['user_id'] = Auth::id();

        // dd($input);

        if(Profile::create($input)) {
            $request->photo->move(public_path('storage/photos'), $input['photo']);
            return redirect()->route('profile')->with('success','Cadastro Realizado com sucesso');
        } else {
            return redirect()->route('profile')->with('error','Erro ao cadastrar');
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
    public function edit()
    {
        $user = User::find(Auth::id())->profile;

        return view('users.profile_create', compact('user'));
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
    		'rg' => 'required',
    		'cpf' => 'required',
    		'phone' => 'required',
    		'emergency_phone' => 'required',
    		'blood_type' => 'required',
    		'gender' => 'required',
    		'allergy' => 'required',
    		'health_problem' => 'required',
    		'take_medication' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $input['photo'] = time().'.'.$request->photo->getClientOriginalExtension();
        $input['rg'] = $request->rg;
        $input['cpf'] = $request->cpf;
        $input['phone'] = $request->phone;
        $input['emergency_phone'] = $request->emergency_phone;
        $input['blood_type'] = $request->blood_type;
        $input['gender'] = $request->gender;
        $input['allergy'] = $request->allergy;
        $input['health_problem'] = $request->health_problem;
        $input['take_medication'] = $request->take_medication;
        $input['user_id'] = Auth::id();

        $profile = User::find($id)->profile;
        $old_photo = $profile->photo;

        if($profile->update($input)) {
            if($request->photo) {
                $request->photo->move(public_path('storage/photos'), $input['photo']);
                $old_photo = public_path('storage/photos/').$old_photo;
                if(file_exists($old_photo)) {
                    unlink($old_photo);
                }
            }
            return back()->with('success','Alteração de Cadastro Realizado com sucesso');
        } else {
            return back()->with('errors','Erro na alteração');
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
        //
    }
}
