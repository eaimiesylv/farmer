

<div class="modal fade" id="createProposalModal" tabindex="-1" role="dialog" aria-labelledby="createProposalModalLabel" aria-hidden="true">
    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPitchModalLabel">Create Proposal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your form or content for creating a pitch here -->
                <!-- Example: -->

                <form method="POST" action="{{ route('dealproposals.store') }}" enctype="multipart/form-data">
                         @csrf
                    <div class="form-group">
                        <label for="title">Proposal title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Proposal title" maxlength=50 required>
                        <span>Max length:50</span>
                    </div>
                    <div class="form-group">
                        <label for="deal">Select deal</label>
                       
                        <select class="form-control" id="deal" name="deal_id" required>
                            @if($deal && count($deal)> 0)
                               
                                @foreach($deal as $dealOption)
                                    <option value="{{ $dealOption['id'] }}">{{ $dealOption['title'] }}</option>
                                @endforeach
                            @else
                                <option value="" disabled>No open deal or Proposal has been created</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter description" maxlength=300 required></textarea>
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