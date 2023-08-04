
<div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="min-width: 800px">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="modal_title">Add Bank Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update.bank')}}" method="POST" id="updateForm">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Bank Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Bank Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="code" placeholder="Bank Code">
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Update Bank Info</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


