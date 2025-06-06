<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UseraddController extends Controller
{
    public function createuser(Request $request)
    {
        $users=User::create([
            'name'=>'Dileep Kumar sen',
            'email'=>'sendileep559@gmail.com',
            'password'=>Hash::make('Dileep@123')
        ]);
        return response()->json([
        'Message'=>200,
        'Data'=>$users
        ]);
    }
}
