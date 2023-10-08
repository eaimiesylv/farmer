

<div class="modal fade" id="createPitchModal" tabindex="-1" role="dialog" aria-labelledby="createPitchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPitchModalLabel">Create Pitch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your form or content for creating a pitch here -->
                <!-- Example: -->
                <form method="POST" action="{{ route('view_pitch.store') }}" enctype="multipart/form-data">
                         @csrf
                    <div class="form-group">
                        <label for="pitchName">Pitch Name</label>
                        <input type="text" class="form-control" id="pitchName" name="pitchname" placeholder="Enter pitch name" maxlength=50 required>
                        <span>Max length:50</span>
                    </div>
                    <div class="form-group">
                        <label for="pitchType">Pitch Type</label>
                        <select class="form-control" id="pitchType" name="pitchtype" required>
                            <option value="1">Business Plan</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pitchFile">Pitch File (Max 2mb:PDF only)</label>
                        <input type="file" class="form-control-file" id="pitchFile" name="pitchfile" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</div>