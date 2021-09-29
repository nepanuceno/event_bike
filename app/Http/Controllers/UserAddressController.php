<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create_address');
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
    		'zip_code' => 'required',
            'address' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);

        $inputs = [
            'user_id' => Auth::id(),
            'zip_code' => $request->zip_code,
            'address' => $request->address,
            'number' => $request->number,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country
        ];

        $user_address = UserAddress::create($inputs);

        return  redirect()->route('profile')->with('success', 'Endereço cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('SHOW');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = UserAddress::find($id);

        return view('users.create_address', compact('address'));
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
    		'zip_code' => 'required',
            'address' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);

        $address = UserAddress::find($id);

        $address->zip_code = $request->zip_code;
        $address->address = $request->address;
        $address->number = $request->number;
        $address->neighborhood = $request->neighborhood;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->country = $request->country;

        $address->save();

        return redirect()->route('profile')->with('success', 'Endereço atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id, 'Delete');
    }
}
