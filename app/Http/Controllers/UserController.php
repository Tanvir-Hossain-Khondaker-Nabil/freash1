<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return view('backend.modules.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.modules.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // password_confirmation will be validated automatically
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        session()->flash('msg', 'Create Successfully');
        session()->flash('cls', 'success');

        return redirect()->route('users.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('backend.modules.user.create', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed', // password_confirmation will be validated automatically
        ]);

        // If the password is not empty, update it
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Update the other user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        session()->flash('msg', 'Update Successfully');
        session()->flash('cls', 'warning');

        return redirect()->route('users.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // $deleteOldImage = $user->photo;
        // if(file_exists($deleteOldImage)){
        //     unlink($deleteOldImage);
        // }

        $user->delete();
        session()->flash('msg', 'Delete Successfully');
        session()->flash('cls', 'error');
        return redirect()->route('users.index');
    }
}
