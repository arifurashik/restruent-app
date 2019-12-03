<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class ProfileController extends Controller
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
        return view('profile.edit', compact('user'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => "required|string|max:191|email|unique:users,email," . $id . ",id",
        ]);
        //update data
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();
        return \Redirect::route('orders.index')->with('message', 'Profile Updated Successfully!');
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        //update data
        $hashedPass = User::find(Auth::id())->password;
        if (Hash::check($request->old_password, $hashedPass)) {
            if (!Hash::check($request->password, $hashedPass)) {

                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->update();

                Auth::logout();
                return redirect()->route('orders.index');
            } else {
                return redirect()->back()->with('message', 'Something Went Wrong!');
            }
        } else {
            return redirect()->back()->with('message', 'Something Went Wrong!');
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
