<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereNotIn('id', [Auth::id()])->latest()->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|string|max:191|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        //save data
        $user = new User();
        $user->role = 2;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return \Redirect::route('users.index')->with('message', 'New User Created Successfully!');
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
        $user = User::find($id);
        return view('user.edit', compact('user'));
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
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => "required|string|max:191|email|unique:users,email," . $id . ",id",
        ]);
        //update data
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();
        return \Redirect::route('users.index')->with('message', 'User Updated Successfully!');
    }

    public function managePassword($id)
    {
        $user = User::find($id);
        return view('user.password', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        //update data
        $hashedPass = User::find($id)->password;
        if (!Hash::check($request->password, $hashedPass)) {

            $user = User::find($id);
            $user->password = Hash::make($request->password);
            $user->update();

            return \Redirect::route('users.index')->with('message', 'Password Updated Successfully!');
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
        $user = User::whereNotIn('id', [Auth::id()])->find($id);
        $user->delete();
        return \Redirect::route('users.index')->with('message', 'User Deleted Successfully!');
    }
}
