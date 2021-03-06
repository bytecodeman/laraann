<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index', ['users' => User::orderBy('name', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('users.register');
    }

    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerStore(UserCreateRequest $request)
    {
        $formFields = $request->validated();

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        auth()->login($user);
        return Redirect('/')->with('message', 'User created and logged in');
    }

    public function adminStore(UserCreateRequest $request)
    {
        $formFields = $request->validated();

        $formFields['password'] = bcrypt($formFields['password']);
        if ($request->has("isAdmin")) {
            $formFields["isAdmin"] = 1;
        } else {
            $formFields["isAdmin"] = null;
        }
        $user = User::create($formFields);

        return Redirect(route('users-manage'))->with('message', 'User created');
    }

    public function showLoginForm()
    {
        return view('users.login');
    }

    public function login(LoginRequest $request)
    {
        $formFields = $request->validated();

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect()->intended()->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    public function logout()
    {
        try {
            auth()->logout();

            Session()->invalidate();
            Session()->regenerateToken();

            return redirect('/')->with('message', 'You have been logged out!');
        } catch (Exception $ex) {
            return redirect('/')->with('message', 'Error logging out!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize("update", $user);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, User $user)
    {
        $this->authorize($user);

        $formFields = $request->validated();
        $formFields['password'] = bcrypt($formFields['password']);
        if ($request->has("isAdmin")) {
            $formFields["isAdmin"] = 1;
        } else {
            $formFields["isAdmin"] = null;
        }
        $user->update($formFields);

        return redirect(route('users-manage'))->with("message", "User Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $announcements = User::find($user->id)->announcements()->latest()->get();
        foreach ($announcements as $announcement) {
            if ($announcement->logo) {
                Storage::disk('public')->delete($announcement->logo);
            }
        }
        $user->delete();
        return Redirect(route('users-manage'))->with("message", "User Deleted Successfully");
    }
}
