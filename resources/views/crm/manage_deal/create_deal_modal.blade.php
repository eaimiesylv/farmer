

<div class="modal fade" id="createDealModal" tabindex="-1" role="dialog" aria-labelledby="createDealModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDealModalLabel">Create Deal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
                <form method="POST" action="{{ route('managedeals.store') }}" enctype="multipart/form-data">
                         @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" maxlength=50 required>
                        <span>Max length: 50 </span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter description" maxlength=300 required></textarea>
                        <span>Max length: 300 </span>
                    </div>
                    <div class="form-group">
                        <label for="deal_value">Deal value</label>
                        <input type="number" class="form-control" id="deal_value" name="deal_value" placeholder="Enter deal_value" required>
                    </div>
                    <div class="form-group">
                        <label for="investor">Select Investor</label>
                        <select class="form-control" id="investor" name="investor_id" required>
                            @if($investor && count($investor) > 0)
                                @foreach($investor as $investorOption)
                                    <option value="{{ $investorOption['id'] }}">{{ $investorOption['fullname'] }}</option>
                                @endforeach
                            @else
                                <option value="" disabled>No investor found</option>
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="expected_closing_date">Expected Closing Date</label>
                        <input type="date" class="form-control" id="expected_closing_date" name="expected_closing_date" placeholder="Enter expected_closing_date" required>
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