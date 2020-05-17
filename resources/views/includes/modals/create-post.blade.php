<div class="modal fade" id="PostModal" tabindex="-1" role="dialog" aria-labelledby="PostModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PostModalLabel">Create a new post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('post.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" type="text" name="title">
                        @if ($errors->has('title'))
                            <small class="error">{{ $errors->first('title') }}</small>
                        @endif
                    </div>
                    <div class="form-group shadow-textarea">
                        <label for="content">Write your post</label>
                        <textarea class="form-control z-depth-1" name="content" id="content" rows="3" placeholder="Write something here...">{{ old('content') }}</textarea>
                        @if ($errors->has('content'))
                            <small class="error">{{ $errors->first('content') }}</small>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Post"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>