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
            <p>Created on: {{ $ticket->created_at->diffForHumans() }}</p>

            <form action="{{ url('tickets/update') }}" method="POST" class="form">
                {!! csrf_field() !!}
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                <div class="d-flex mb-4 align-items-center">
                    <span class="me-1">Assign To: </span>
                    <div class="form-group col-lg-4">
                        <select 
                            id="developer_id" 
                            type="developer" 
                            class="form-select{{ $errors->has('developer_id') ? ' is-invalid' : '' }}" name="developer_id" 
                            {{$ticket->status == 'Closed' ? 'disabled' : ''}}
                        >
                            <option value="">Select Developer</option>
                            @foreach ($developers as $developer)
                                <option value="{{ $developer->id }}" {{$ticket->developer_id == $developer->id ? 'selected' : ''}}>{{ $developer->name }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('developer_id'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('developer_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
@endsection