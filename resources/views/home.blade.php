@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form id="comment-form" method="post" action="{{ route('comments.store') }}" >
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
                        <div class="row" style="padding: 10px;">
                            <div class="form-group">
                                <textarea class="form-control" name="comment" placeholder="Write something from your heart..!"></textarea>
                            </div>
                        </div>
                        <div class="row" style="padding: 0 10px 0 10px;">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-lg" style="width: 100%" name="submit">
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row">
         <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Comments</div>

                <div class="panel-body comment-container" >
                    
                    @foreach($comments as $comment)
                        <div class="well">
                            <i><b> {{ $comment->name }} </b></i>
                            <span> {{ $comment->comment }} </span>
                            <div style="margin-left:10px;">
                                <a href="#" cid="{{ $comment->id }}" name_a="{{ Auth::user()->name }}" class="reply">Reply</a>&nbsp;
                                <a href="#">Delete</a>
                                <div class="reply-form">
                                    
                                    <!-- Dynamic Reply form -->
                                    
                                </div>
                                @foreach($comment->replies as $rep)
                                     @if($comment->id === $rep->comment_id)
                                        <div class="well">
                                            <i><b> {{ $rep->name }} </b></i>
                                            <span> {{ $rep->reply }} </span>
                                        </div>
                                    @endif 
                                @endforeach
                                
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    
    $(document).ready(function(){

        $(".comment-container").delegate(".reply","click",function(){

            var well = $(this).parent().parent();
            var cid = $(this).attr("cid");
            var name = $(this).attr('name_a');
            var form = '<form method="post" action="{{ route('replies.store') }}">{{ csrf_field() }}<input type="hidden" name="comment_id" value="'+ cid +'"><input type="hidden" name="name" value="'+name+'"><div class="form-group"><textarea class="form-control" name="reply" placeholder="Enter your reply" > </textarea> </div> <div class="form-group"> <input class="btn btn-primary" type="submit"> </div></form>';

            well.find(".reply-form").append(form);



        });

    });
    

</script>
