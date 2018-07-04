$(document).ready(function(){
        

        $(".comment-container").delegate(".reply","click",function(){

            var well = $(this).parent().parent();
            var cid = $(this).attr("cid");
            var name = $(this).attr('name_a');
            var token = $(this).attr('token');
            var form = '<form method="post" action="/replies"><input type="hidden" name="_token" value="'+token+'"><input type="hidden" name="comment_id" value="'+ cid +'"><input type="hidden" name="name" value="'+name+'"><div class="form-group"><textarea class="form-control" name="reply" placeholder="Enter your reply" > </textarea> </div> <div class="form-group"> <input class="btn btn-primary" type="submit"> </div></form>';

            well.find(".reply-form").append(form);



        });

        $(".comment-container").delegate(".delete-comment","click",function(){

        	var cdid = $(this).attr("comment-did");
        	var token = $(this).attr("token");
        	var well = $(this).parent().parent();
        	$.ajax({
                    url : "/comments/"+cdid,
                    method : "POST",
                    data : {_method : "delete", _token: token},
                    success:function(response){
                    if (response == 1 || response == 2) {
                        well.hide();
                    }else{
                        alert('Oh ! you can delete only your comment');
                        console.log(response);
                    }
                }
            });

        });

        $(".comment-container").delegate(".reply-to-reply","click",function(){
            var well = $(this).parent().parent();
            var cid = $(this).attr("rid");
            var rname = $(this).attr("rname");
            var token = $(this).attr("token")
            var form = '<form method="post" action="/replies"><input type="hidden" name="_token" value="'+token+'"><input type="hidden" name="comment_id" value="'+ cid +'"><input type="hidden" name="name" value="'+rname+'"><div class="form-group"><textarea class="form-control" name="reply" placeholder="Enter your reply" > </textarea> </div> <div class="form-group"> <input class="btn btn-primary" type="submit"> </div></form>';

            well.find(".reply-to-reply-form").append(form);

        });

        $(".comment-container").delegate(".delete-reply", "click", function(){

            var well = $(this).parent().parent();

            if (confirm("Are you sure you want to delete this..!")) {
                var did = $(this).attr("did");
                    var token = $(this).attr("token");
                    $.ajax({
                        url : "/replies/"+did,
                        method : "POST",
                        data : {_method : "delete", _token: token},
                        success:function(response){
                            if (response == 1) {
                                well.hide();
                                //alert("Your reply is deleted");
                            }else if(response == 2){
                                alert('Oh! You can not delete other people comment');
                            }else{
                                alert('Something wrong in project setup');
                            }
                        }
                    })
            }

            

        });

    }); 