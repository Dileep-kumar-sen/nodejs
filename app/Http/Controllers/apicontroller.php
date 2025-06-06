<?php

namespace App\Http\Controllers;


use DB;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Service\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class apicontroller extends Controller
{
    protected $apiservice;
    public function __construct(ApiService $apiService)
    {
        $this->apiservice = $apiService;
    }
    public function checkvalidator(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json([
                'Message' => 200,
                "error" => $validate->errors()
            ]);
        } else {
            $email = $request->email;
            $check = User::where('email', $email)->first();
            if ($check) {
                $checkingpassword = Hash::check($request->password, $check->password);
                if ($checkingpassword) {
                    $token = $check->createToken('token')->plainTextToken;
                    return response()->json([
                        'Status' => 200,
                        'token' => $token,
                        'Message' => 'Login Successfully'
                    ]);
                } else {
                    return response()->json([
                        'Message' => 'Password Incorrect'
                    ]);
                }
            } else {
                return response()->json([
                    'Message' => 'Email Id Not Found'
                ]);
            }
        }
    }
    public function getdata()
    {
        $alldata = User::all();
        return $alldata;
    }
    public function checking(User $user)
    {
        return route('getdata');
    }
    public function test()
    {


$response = Http::get('https://jsonplaceholder.typicode.com/posts/1');

$data = $response->json();
return $data;


    }
    public function best()
    {
        $post = Comment::find(1);
        return $post->post;
    }

}
