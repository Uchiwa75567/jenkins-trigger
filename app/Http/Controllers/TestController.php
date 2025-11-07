<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $message = $request->input('message', 'Hello depuis Laravel & Jenkins 🚀');
        $time = Carbon::now()->toDateTimeString();
        return response()->json([
            'message' => $message,
            'time' => $time
        ]);
    }
}
