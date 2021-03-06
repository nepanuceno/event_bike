<?php

namespace App\Http\Controllers\User;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);

        return view('users.index',compact('data'))

            ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    public function search(Request $request)
    {
        $keyworks = $request->term;

        if($keyworks){
            $users = User::where('name', 'like', '%'.$keyworks.'%')
            ->orwhere('name', 'like', '%'.$keyworks.'%')->get();

            return json_encode( $users );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('register');
    }


     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register_manager()
    {
        return view('users.register_manager');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('users.show',compact('user'));
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
        $user = User::find($id);

        if($user) {
            if ($user->profile) {
                $photo = public_path('storage/photos/'.$user->profile->photo);
                try {
                    if (file_exists($photo)){
                        unlink($photo);
                    }
                } catch (Throwable $e) {
                    report($e);
                    return back()->with('error',$e);
                }
            }

            try {
                $user->delete();
            } catch (Throwable $e) {
                report($e);
                return back()->with('error',$e);
            }
            return back()->with('success','Usu??rio Eclu??do com sucesso');
        } else {
            return back()->with('error','Usu??rio n??o encontrado');
        }

    }
}
