
<style>
    a{
        font-size: 15px;
    }
</style>

<div class="comment-content text-center">
    <h1 class="text-center font-sans font-bold m-3" style="font-size:25px">Comments</h1>
    <form action="{{ url('add_comment') }}" method="POST">
        @csrf
        <textarea name="comment" style="height: 150px; width:600px" cols="20" rows="5" placeholder="Add a comment" required></textarea>
        <br>
        <input type="submit" value="Comment" class="mb-3" style="font-size:15px">
    </form>
</div>

@if($comment->count() > 0)
<!-- Display Comments and Replies -->
<div class="mb-5">
<h2 class="text-center font-sans font-bold mb-3" style="font-size:20px">All Comments</h2>
<div class="reply-content mb-5" style="padding-left:30%">

    @foreach ($comment as $comment)
        <b>{{ $comment->name }}</b>
        <p class="">{{ $comment->comment }}</p>

        <div class="d-flex">
            <div>
                <!-- Reply to Comment -->
                <a href="javascript:void(0);" style="color: blue;font-weight:300;" data-Commentid="{{ $comment->id }}" onclick="reply(this)">Reply</a>

                <!-- Update Comment -->
                <a href="javascript:void(0);" style="color: orange;font-weight:300;" onclick="editComment({{ $comment->id }}, '{{ $comment->comment }}')">Edit</a>

                <!-- Delete Comment -->
                <a href="{{ url('delete_comment', $comment->id) }}" style="color: red;font-weight:300;" onclick="return confirm('Are you sure to delete?')">Delete</a>

                <!-- Display replies associated with the comment -->
                @foreach ($reply->where('comment_id', $comment->id) as $reply)
                    <div style="padding-left:3%; padding-bottom:10px;">
                        <b class="px-3">{{ $reply->name }}</b>
                        <p class="px-3">{{ $reply->reply }}</p>
                        <div class="d-flex gap-2 px-3">
                        <!-- Reply to Reply -->
                        <a href="javascript:void(0);" style="color: blue;font-weight:300;" data-Commentid="{{ $reply->id }}" onclick="reply(this)">Reply</a>

                        <!-- Edit Reply -->
                        <a href="javascript:void(0);" style="color: orange;font-weight:300;" onclick="editReply({{ $reply->id }}, '{{ $reply->reply }}')">Edit</a>

                        <!-- Delete Reply -->
                        <a href="{{ url('delete_reply', $reply->id) }}" style="color: red;font-weight:300;" onclick="return confirm('Are you sure to delete this reply?')">Delete</a>
                         </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

<!-- Reply Form -->
<div class="replyDiv" style="display: none;">
    <form action="{{ url('add_reply') }}" method="POST">
        @csrf
        <input type="hidden" id="commentId" name="commentId">
        <textarea name="reply" cols="10" rows="3" style="height:100px; width:500px;" placeholder="Reply something here"></textarea>
        <br>
        <button type="submit" class="btn-sm btn-warning">Reply</button>
        <a href="javascript:void(0);" class="btn-sm" onclick="reply_close(this)">Close</a>
    </form>
</div>

<!-- Update Comment Form (hidden initially) -->
<div id="editCommentForm" style="display: none; padding-left:30%">
    <form action="{{ url('update_comment') }}" method="POST">
        @csrf
        <input type="hidden" id="editCommentId" name="commentId">
        <textarea name="comment" id="editCommentText" cols="10" rows="3" style="height:100px; width:500px;" placeholder="Update your comment"></textarea>
        <br>
        <button type="submit" class="btn-sm btn-warning ">Update Comment</button>
        <a href="javascript:void(0);" class="btn-sm" onclick="edit_comment_close()">Cancel</a>
    </form>
</div>

<!-- Update Reply Form (hidden initially) -->
<div id="editReplyForm" style="display: none;padding-left:30%">
    <form action="{{ url('update_reply') }}" method="POST">
        @csrf
        <input type="hidden" id="editReplyId" name="replyId">
        <textarea name="reply" id="editReplyText" cols="10" rows="3" style="height:100px; width:500px;" placeholder="Update your reply"></textarea>
        <br>
        <button type="submit" class="btn-sm btn-warning">Update Reply</button>
        <a href="javascript:void(0);" class="btn-sm" onclick="edit_reply_close()">Cancel</a>
    </form>
</div>

@else
<p class="text-center m-4 font-sans text-sm fs-6 fw-bold"> No comments yet posted</p>
@endif
</div>
<!-- JavaScript -->
<script type="text/javascript">
    function reply(caller) {
        document.getElementById('commentId').value = $(caller).attr('data-Commentid');
        $('.replyDiv').insertAfter($(caller));
        $('.replyDiv').show();
    }

    function reply_close() {
        $('.replyDiv').hide();
    }

    function editComment(commentId, commentText) {
        document.getElementById('editCommentId').value = commentId;
        document.getElementById('editCommentText').value = commentText;
        document.getElementById('editCommentForm').style.display = 'block';
    }

    function edit_comment_close() {
        document.getElementById('editCommentForm').style.display = 'none';
    }

    function editReply(replyId, replyText) {
        document.getElementById('editReplyId').value = replyId;
        document.getElementById('editReplyText').value = replyText;
        document.getElementById('editReplyForm').style.display = 'block';
    }

    function edit_reply_close() {
        document.getElementById('editReplyForm').style.display = 'none';
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var scrollpos = localStorage.getItem('scrollpos');
        if (scrollpos) window.scrollTo(0, scrollpos);
    });

    window.onbeforeunload = function(e) {
        localStorage.setItem('scrollpos', window.scrollY);
    };
</script>
