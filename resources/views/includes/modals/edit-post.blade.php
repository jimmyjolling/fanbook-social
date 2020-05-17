<div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="PostModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PostModalLabel">Edit post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('post.edit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" id="title-edit" name="title-edit" value="{{ old('title-edit') }}">
                        @if ($errors->has('title-edit'))
                            <small class="error"><?php echo 'This field is required.' ?></small>
                        @endif
                    </div>
                    <div class="form-group shadow-textarea">
                        <label for="content">Write your post</label>
                        <textarea class="form-control z-depth-1" name="content-edit" id="content-edit" rows="3" placeholder="Write something here...">{{ old('content-edit') }}</textarea>
                        @if ($errors->has('content-edit'))
                            <small class="error"><?php echo 'This field is required.' ?></small>
                        @endif
                    </div>
                    <input type="hidden" id="post-id" name="post_id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Edit"></button>
                        </form>
                        <form action="{{ route('post.delete') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="post-id-delete" name="post-id-delete">
                            <input type="submit" class="btn btn-danger" value="Delete"></button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>