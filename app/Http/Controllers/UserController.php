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
        return response()->json(User::get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
          //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->save();
        return response()->json(['message' => 'User created successfully', 'data' => $user], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userId = User::find($id);
        return response()->json($userId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $user = User::find($id);
    if (!$user) {
        return response()->json(['message' => 'User not found.'], 404);
    }
    $user->update($request->all());
    return response()->json(['message' => 'User updated successfully', 'data' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteUser = User::find($id);
         $deleteUser->delete();
         return response()->json();
    }
}
