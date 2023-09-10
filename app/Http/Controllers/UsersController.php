<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
   
    public function user()
    {
        $user = users::where('id', 1)->get();

        return view('user', ['user' => $user]);
    }


    public function edit()
    {
        $user = users::where('id', 1)->get();

        return view('edit', ['user' => $user]);
    }

   
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(users $users)
    {
        //
    }

   
//     public function update(Request $request, $id)
// {
// $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|email|max:255',
//         'phone' => 'required|string|max:20',
//         'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//     ]);

//     // Update the user data based on the form input
//     $user = users::find($id);

//     if (!$user) {
//         return redirect()->back()->with('error', 'User not found');
//     }

//     $user->name = $request->input('name');
//     $user->email = $request->input('email');
//     $user->phone = $request->input('phone');
//     $user->photo = $request->input('photo');


//     $user->save();

//     return redirect('user');
// }


public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);


   
    $user = users::find($id); // Note the capital 'User' and 'users' table name

    if (!$user) {
        return redirect()->back()->with('error', 'User not found');
    }

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->phone = $request->input('phone');

    // Handle photo upload
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photoPath = $photo->store('public/myimg'); // Store the uploaded file in the 'public/myimg' directory
        $user->photo = str_replace('public/', '', $photoPath); // Remove 'public/' from the file path
    }
    

    $user->save();

    return redirect('user');
}
}