@extends('layouts.app')

@section('content')
    
    <div class="d-flex align-items-center justify-content-between">
        <h3>Users</h3>
        <a href="{{ url('new-user') }}" class="btn btn-success">Add New User</a>
    </div>
    
    @if ($users->isEmpty())
        <p>There are currently no Users.</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Last Updated</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>     
                        {{ $user->email }}
                    </td>

                    <td>
                        @if ($user->is_admin == 0 && $user->is_developer == 0)
                            Client
                        @elseif ($user->is_admin == 0 && $user->is_developer == 1)
                            Developer
                        @else
                            Admin
                        @endif
                    </td>
              
                    <td>{{ $user->updated_at }}</td>
                    
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $users->render() }}
    @endif

@endsection
