<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function log(Request $request)
    {
        try
        {
            $input = $request->all();
            Log::create($input);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}
