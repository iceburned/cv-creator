<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(CreateUserRequest $request)
    {
        $validated =  $request->validated();
        $user = User::firstOrCreate([
            'name' => $validated['name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'birth_date' => $validated['birth_date'],
        ]);

        return $user;
    }
}
