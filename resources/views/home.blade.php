

@extends('layouts.app')

@section('content')

    <h3>Dashboard</h3>

    <div class="d-flex align-items-center justify-content-around mt-5" >

        @if(Auth::user()->is_developer != 1)
            <div class="card border-success" style="padding: 50px">
                <div class="card-header text-success">Open: {{$open}}</div>
            </div>
        @endif
        
        <div class="card border-warning" style="padding: 50px">
            <div class="card-header text-warning">Assigned: {{$assigned}}</div>
        </div>

        <div class="card border-danger" style="padding: 50px">
            <div class="card-header text-danger">Closed: {{$closed}}</div>
        </div>
    </div>
            
@endsection
