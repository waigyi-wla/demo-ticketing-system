@extends('layouts.app')

@section('content')
    
    <div class="d-flex align-items-center justify-content-between">
        <h3>Categories</h3>
    </div>
    
    @if ($categories->isEmpty())
        <p>There are currently no categories.</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Created</th>
                <th>Last Updated</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>
                        {{ $category->name }}
                    </td>
                    <td>     
                    {{ $category->created_at }}
                    </td>
              
                    <td>{{ $category->updated_at }}</td>
                    
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $categories->render() }}
    @endif

@endsection
