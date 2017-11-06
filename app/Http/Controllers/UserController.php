<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\SaveUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            $users = User::where('email', 'LIKE', '%' . $search . '%')
                           ->orWhere('name', 'LIKE', '%' . $search . '%')
                           ->withTrashed()
                           ->paginate(15)
                           ->appends($request->input());
        } else {
            $users = User::withTrashed()->paginate(15);
        }

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveUserRequest $request)
    {
        $user = User::create($request->all());
        
        return redirect()->route('users.edit', $user)->with('success', 'User '. $user->name .' successfuly created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(SaveUserRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        if (!is_null($request->password)) {
            $user->password = $request->password;
        }
        $user->save();
        
        return redirect()->back()->with('success', 'User updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return abort(503);
    }
    
    /**
     * Inactivate the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function inactivate(User $user)
    {
        if ($user->id == auth()->id()) { 
            return redirect()->route('users.index')->withErrors("Can't inactivate your own user."); 
        } 

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User ' . $user->name . ' inactivated.');
    }
    
    /**
     * Activate the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate(int $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.index')->with('success', 'User ' . $user->name . ' reactivated.');
    }
}
