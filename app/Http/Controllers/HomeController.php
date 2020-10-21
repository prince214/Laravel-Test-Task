<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tickets;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
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
    public function buy_tickets(){
        $tickets= new Tickets();
        $all_tickets = $tickets->get_all_tickets();
        return view('tickets')->with('tickets',$all_tickets);
    }

}
