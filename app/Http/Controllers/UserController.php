<?php

namespace App\Http\Controllers;

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
        $users = User::all();
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
            'password' => 'required|min:6|confirmed',
        ]);

        $photo = null;
        if ($file = $request->file('photo')) {
            $photoName = time() . '.' . $file->getClientOriginalExtension();
            $photo = $file->move('upload/image/', $photoName);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $photo,
        ]);

        session()->flash('msg', 'User created successfully.');
        session()->flash('cls', 'success');

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('backend.modules.user.show', compact('user'));
    }

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
            'password' => 'required|min:6|confirmed',
        ]);

        $user_data = $request->except(['photo']);

        if ($file = $request->file('photo')) {
            $deleteOldImage = $user->photo;
            if ($deleteOldImage && file_exists(public_path($deleteOldImage)) && is_file(public_path($deleteOldImage))) {
                unlink(public_path($deleteOldImage)); 
            }

            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $user_data['photo'] = $file->move('upload/image/', $imageName);
        } else {
            $user_data['photo'] = $user->photo;
        }

        $user->update($user_data);

        session()->flash('msg', 'User updated successfully.');
        session()->flash('cls', 'warning');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->photo && file_exists(public_path($user->photo)) && is_file(public_path($user->photo))) {
            unlink(public_path($user->photo)); 
        }

        $user->delete();

        session()->flash('msg', 'User deleted successfully.');
        session()->flash('cls', 'error');

        return redirect()->route('users.index');
    }
}
