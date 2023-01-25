<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   

        $open = Ticket::where('status', 'Open')->count();
        $assigned = Ticket::where('status', 'Assigned')->count();
        $closed = Ticket::where('status', 'Closed')->count();

        //user
        if(Auth::user()->is_admin == 0 && Auth::user()->is_developer == 0){
            $open = Ticket::where([['status', '=', 'Open'], ['user_id', '=', Auth::user()->id]])->count();
            $assigned = Ticket::where([['status', '=', 'Assigned'], ['user_id', '=', Auth::user()->id]])->count();
            $closed = Ticket::where([['status', '=', 'Closed'], ['user_id', '=', Auth::user()->id]])->count();
        }
        //developer
        elseif(Auth::user()->is_admin == 0 && Auth::user()->is_developer == 1){
            $open = Ticket::where([['status', '=', 'Open'], ['developer_id', '=', Auth::user()->id]])->count();
            $assigned = Ticket::where([['status', '=', 'Assigned'], ['developer_id', '=', Auth::user()->id]])->count();
            $closed = Ticket::where([['status', '=', 'Closed'], ['developer_id', '=', Auth::user()->id]])->count();
        }
        
        return view('home', compact('open', 'assigned', 'closed'));
    }
}
