
@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <strong>{{$comment->username}}</strong>
        <p>{{ $comment->comment }}</p>
        @if(session()->has('id'))
        <a href="javascript:void(0)" id="reply" data-blog="{{$blog->id}}" data-id="{{$comment->id}}">reply</a>
        @else
        <a href="{{url('login')}}">reply</a>
        @endif
        @php $replies = blog_comments($blog_id,$comment->id);@endphp
        @include('public.partials.commentsDisplay',['comments'=>$replies,'blog_id'=>$blog_id])
    </div>
@endforeach