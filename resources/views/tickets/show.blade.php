@extends('layouts.app')

@section('title', $ticket->title)

@section('content')


    <div class="card">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <h5 class="card-title">
                {{ $ticket->title }}
            </h5>
            <h6 class="card-subtitle mb-2 text-muted">
                #{{ $ticket->code }}
            </h6>
            <p class="card-text">
                <p>{{ $ticket->description }}</p>
            </p>
            <p>Category: {{ $ticket->category->name }}</p>
            <p>
                @if ($ticket->status === 'Open')
                    Status: <span class="badge bg-success">{{ $ticket->status }}</span>
                @elseif ($ticket->status === 'Assigned')
                    Status: <span class="badge bg-warning">{{ $ticket->status }}</span>
                @else
                    Status: <span class="badge bg-danger">{{ $ticket->status }}</span>
                @endif
            </p>
            <p>Priority: {{ ucwords($ticket->priority) }}</p>
            <p>Created By: {{ $ticket->user->name }}</p>
            <p>Assign To: {{ $ticket->developer ? $ticket->developer->name : 'N/A' }}</p>
            <p>Created on: {{ $ticket->created_at->diffForHumans() }}</p>
        </div>
    </div>
    <hr>
    @include('comments.comments')
    <hr>
    @include('comments.reply')

@endsection