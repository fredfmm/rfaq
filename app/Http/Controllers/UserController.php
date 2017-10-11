<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Http\Requests\SaveUserRequest;
use \App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List all users.
     *
     * @return void
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

        return view('user.index', compact('users', $users));
    }

    /**
     * Show the user save/edit form.
     *
     * @return void
     */
    public function form(User $user)
    {
        return view('user.form', compact('user', $user));
    }

    /**
     * Show a specific user
     *
     * @param User $user
     * @return void
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Save or update an user
     *
     * @param SaveUserRequest $request
     * @param User $user
     * 
     * @return void
     */
    public function save(SaveUserRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        if (!is_null($request->password)) {
            $user->password = $request->password;
        }
        $user->save();

        return redirect()->route('user.edit', [$user])->with('success', 'User saved.');
    }

    /**
     * Inactivate an user.
     *
     * @param User $user
     * 
     * @return void
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users')->with('success', 'User ' . $user->name . ' inactivated.');
    }

    /**
     * Restore an user.
     *
     * @param int $id
     * 
     * @return void
     */
    public function restore(int $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users')->with('success', 'User ' . $user->name . ' reactivated.');
    }
}
