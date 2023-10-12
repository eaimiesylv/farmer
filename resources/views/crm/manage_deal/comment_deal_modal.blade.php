
<div class="modal fade" id="commentDealModal" tabindex="-1" role="dialog" aria-labelledby="commentDealModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="commentDealModalLabel">
                    <img src="{{ asset('images/profile.png') }}" class="rounded-circle" width="50" height="50"/>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <!-- <form method="POST" action="{{ route('managedeals.store') }}" enctype="multipart/form-data">
                                @csrf
                        
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Enter description" maxlength=300 required></textarea>
                                <span>Max length: 300 </span>
                            </div>
                        
                            <!-- <div class="form-group">
                                <label for="investor">Select Investor</label>
                                <select class="form-control" id="investor" name="investor_id" required>
                                    @if(!empty($investor))
                                        @foreach($investor as $investorOption)
                                            <option value="{{ $investorOption['id'] }}">{{ $investorOption['fullname'] }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>No investor found</option>
                                    @endif
                                </select>
                            </div> -->

                            
                            <div class="modal-footer">
                        
                                <input type="submit" value = "comment" class="btn btn-primary">
                            </div>
                        </form> -->
                    </div>
                    <div class="col-md-4">
                        <ul>
                            <li><h6 class="title">Stage</h6>
                                 <p class="description">Inital discussion</p>
                             </li>
                             <li><h6 class="title">Deal value</h6>
                                 <p class = "description">$ 45</p>
                             </li>
                             <li><h6 class="title">Proposal</h6>
                                 <p class = "description">0</p>
                             </li>
                             <li><h6 class="title">Expected closing date</h6>
                                 <p class = "description">2023-10-05</p>
                             </li>
                         </ul>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>