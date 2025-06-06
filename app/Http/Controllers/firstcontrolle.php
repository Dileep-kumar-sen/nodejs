<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class firstcontrolle extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return "Sunday Will not Count For Salary";
    }
}
