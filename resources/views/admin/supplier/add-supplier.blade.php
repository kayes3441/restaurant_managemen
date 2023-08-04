<div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="min-width: 800px">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="modal_title">Add Supplier Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('create.supplier')}}" method="POST" id="addForm">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Supplier Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" placeholder="Supplier Name">
                            <span class="text-danger"id="name_error"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Supplier Mobile Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="mobile" placeholder="Supplier Mobile Number">
                            <span class="text-danger"id="mobile_error"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Supplier Address</label>
                        <div class="col-sm-9">
                            <textarea  class="form-control" name="address" placeholder="Supplier Address"></textarea>
                            <span class="text-danger"id="address_error"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Initial Balance</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="initial_balance" placeholder="Initial Balance">
                            <span class="text-danger"id="initial_balance_error"></span>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="balance_title">
                                <option disabled selected>--Select Balance Title--</option>
                                <option value="Debit">Debit</option>
                                <option value="Credit">Credit</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Create Supplier Info</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


