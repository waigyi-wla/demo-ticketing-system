@extends('layouts.app')

@section('content')

    <div class="row">
        
        <h3>Open New Ticket</h3>

        <div class="card p-4">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST">
                {!! csrf_field() !!}

                <div class="row mb-3">
                    <label for="title" class="col-md-3 col-form-label">Title</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}">

                        @if ($errors->has('title'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="category_id" class="col-md-3 col-form-label">Category</label>

                    <div class="col-md-6">
                        <select id="category_id" type="category" class="form-select{{ $errors->has('category_id') ? ' is-invalid' : '' }}" name="category_id">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('category_id'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('category_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="priority" class="col-md-3 col-form-label">Priority</label>

                    <div class="col-md-6">
                        <select id="priority" type="" class="form-select{{ $errors->has('priority') ? ' is-invalid' : '' }}" name="priority">
                            <option value="">Select Priority</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>

                        @if ($errors->has('priority'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('priority') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="description" class="col-md-3 col-form-label">Description</label>

                    <div class="col-md-6">
                        <textarea rows="5" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description"></textarea>

                        @if ($errors->has('description'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-ticket"></i> Open Ticket
                    </button>

                </div>
            </form>
        </div>
           
    </div>


@endsection