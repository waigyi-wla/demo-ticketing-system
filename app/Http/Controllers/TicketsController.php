<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $conditions = [];
        //user
        if(Auth::user()->is_admin == 0 && Auth::user()->is_developer == 0){
            $conditions[] = [
                'user_id', '=', Auth::user()->id
            ];
        }
        //developer
        elseif(Auth::user()->is_admin == 0 && Auth::user()->is_developer == 1){
            $conditions[] = [
                'developer_id', '=', Auth::user()->id
            ];
        }
        
        $tickets = Ticket::where($conditions)->paginate(10);
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'priority' => 'required',
            'description' => 'required'
        ]);

        $ticket = new Ticket([
            'title' => $request->input('title'),
            'user_id' => Auth::user()->id,
            'code' => Str::uuid(),
            'category_id' => $request->input('category_id'),
            'priority' => $request->input('priority'),
            'description' => $request->input('description'),
            'status' => "Open"
        ]);
        $ticket->save();
        return redirect()->back()->with("status", "A ticket with ID: #$ticket->code has been opened.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $ticket = Ticket::where('code', $code)->firstOrFail();
        return view('tickets.show', compact('ticket'));
    }

    public function close($code)
    {   
        $ticket = Ticket::where('code', $code)->firstOrFail();
        $ticket->status = "Closed";
        $ticket->save();
        return redirect()->back()->with("status", "The ticket has been closed.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {   
        $developers = User::where('is_developer', 1)->get();
        $ticket = Ticket::where('code', $code)->firstOrFail();
        return view('tickets.edit', compact('ticket', 'developers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'developer_id' => 'required',
        ]);
        $ticket = Ticket::where('id', $request->ticket_id)->firstOrFail();
        $ticket->developer_id =  $request->developer_id;
        $ticket->status = 'Assigned';
        $ticket->save();
        return redirect()->back()->with("status", "Developer has been assigned.");
    }
}
