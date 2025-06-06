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
            'name'=>'jai hind jai bharat',
            'email'=>'this is best option for you',
            'password'=>Hash::make('nice to work')
        ]);
        return response()->json([
        'Message'=>200,
        'Data'=>$users
        ]);
    }
}
