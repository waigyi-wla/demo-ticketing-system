@extends('layouts.app')

@section('content')
    
    <div class="d-flex align-items-center justify-content-between">
        <h3>Users</h3>
        @if(Auth::user()->is_developer != 1)
            <a href="{{ url('new-ticket') }}" class="btn btn-success">Open new ticket</a>
        @endif
    </div>
    
    @if ($tickets->isEmpty())
        <p>There are currently no tickets.</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Category</th>
                <th>Title</th>
                <th>Status</th>
                <th>Priority</th>
                <th>CreatedBy</th>
                <th>AssignedTo</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td>
                        {{ $ticket->category->name }}
                    </td>
                    <td>     
                        {{ $ticket->title }}
                    </td>

                    <td>
                        @if ($ticket->status === 'Open')
                            <span class="badge bg-success">{{ $ticket->status }}</span>
                        @elseif ($ticket->status === 'Assigned')
                            <span class="badge bg-warning">{{ $ticket->status }}</span>
                        @else
                            <span class="badge bg-danger">{{ $ticket->status }}</span>
                        @endif
                    </td>
                    <td>{{ ucwords($ticket->priority) }}</td>
                    <td>{{$ticket->user->name}}</td>
                    <td>
                        @if ($ticket->developer)
                            {{ $ticket->developer->name }}
                        @else
                            N/A
                        @endif
                    </td>
                    
                    <td>
                        <a href="{{ url('tickets/'. $ticket->code) }}">
                            View
                        </a>
                        @if(Auth::user()->is_admin == 1)
                        | 
                        <a href="{{ url('tickets/edit/'. $ticket->code) }}" class="text-warning">
                            Edit
                        </a>
                        |
                        <a href="{{ url('tickets/close/'. $ticket->code) }}" class="text-danger">
                            Close
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $tickets->render() }}
    @endif

@endsection

@push('styles')
    <link href="{{ asset('css/Ticket/index.css') }}" rel="stylesheet">
@endpush