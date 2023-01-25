

<form action="{{ url('comment') }}" method="POST" class="form">
    {!! csrf_field() !!}

    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

    <div class="form-group">
        <textarea rows="5" id="comment" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" placeholder="Comment..." name="comment"></textarea>

        @if ($errors->has('comment'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('comment') }}</strong>
            </span>
        @endif
    </div>
    <br />
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
