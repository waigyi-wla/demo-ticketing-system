<div class="comments">
    @foreach($ticket->comments as $comment)
        <div class="card border border-{{$ticket->user->id === $comment->user_id ? 'default' : 'success'}}">
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>{{ $comment->comment }}</p>
                    <footer class="blockquote-footer">
                        {{ $comment->user->name }} 
                        <cite title="Source Title">- {{ $comment->created_at->format('Y-m-d') }}</cite>
                    </footer>
                </blockquote>
            </div>
        </div>
        <br/>
    @endforeach
</div>