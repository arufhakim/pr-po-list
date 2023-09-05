<?php

namespace App\Http\Controllers;

use App\PR;
use App\PO;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('approved');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('dashboard',[
            'purchase_request' => PR::latest('created_at')->take(100)->get(),
            'purchase_order' => PO::latest('updated_at')->take(100)->get(),
        ]);
    }
}
