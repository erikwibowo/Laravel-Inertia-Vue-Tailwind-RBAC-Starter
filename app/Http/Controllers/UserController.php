<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('User/User/Index', [
            'q'     => $request->q,
            'users' => User::when($request->q, function($query, $q){
                $query->where('name', 'LIKE', "%".$q."%");
                $query->Orwhere('email', 'LIKE', "%".$q."%");
            })->orderBy('id', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('User/User/Create');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
            ]);
            return to_route('user.index')->with('success', 'User '.$user->name.' created successfully.');
        } catch (\Throwable $th) {
            return to_route('user.index')->with('error', 'Error creating user. '.$th->getMessage());
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
    public function edit($id)
    {
        return Inertia::render('User/User/Edit', [
            'user' => User::findOrFail($id)
        ]);
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
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => 'unique:users,email,'.$id,
            'password'              => 'sometimes|string|min:8|confirmed',
            'password_confirmation' => 'sometimes|required_with:password|same:password',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
            ]);
            return to_route('user.index')->with('success', 'User '.$user->name.' updated successfully.');
        } catch (\Throwable $th) {
            return to_route('user.index')->with('error', 'Error updating user. '.$th->getMessage());
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
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return to_route('user.index')->with('success', 'User '.$user->name.' deleted successfully.');
        } catch (\Throwable $th) {
            return to_route('user.index')->with('error', 'Error deleting user. '.$th->getMessage());
        }
    }
}