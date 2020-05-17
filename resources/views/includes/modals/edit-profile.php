<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit your profile information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.update', ['id' => $profile->user_id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="Work">Where do you work?</label>
                        <input class="form-control" type="text" name="work" value="{{ $profile->work }}">
                    </div>
                    <div class="form-group">
                        <label for="location">Where do you live?</label>
                        <input class="form-control" type="text" name="location" value="{{ $profile->location }}">
                    </div>
                    <div class="form-group">
                        <label for="heritage">Where did you grew up?</label>
                        <input class="form-control" type="text" name="heritage" value="{{ $profile->heritage }}">
                    </div>
                    <div class="form-group">
                        <label for="location">Upload a profile picture</label>
                        <input type="file" name="image">
                    </div>
                    <div class="form-group">
                        <label for="relation_status">Are you in a relationship?&nbsp;&nbsp;</label>
                        <input type="checkbox" value="1" name="relation_status" id="relation_status">
                        
                        <input class="form-control" type="text" name="relation" id="relation" placeholder="With who are you in a relationship?">
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save changes"></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>