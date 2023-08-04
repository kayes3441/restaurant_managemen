

<div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="min-width: 800px">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Edit Supplier Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update.customer')}}" method="POST" id="updateForm">
                    @csrf
                    <input type="hidden" name="id" >
                    <input type="hidden" name="sl" >
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Customer Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name"  placeholder="Customer Name">
                            <span class="text-danger" id="edit_name_error"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Customer Mobile Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="mobile" placeholder="Customer Mobile Number">
                            <span class="text-danger" id="edit_mobile_error"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Customer Address</label>
                        <div class="col-sm-9">
                            <textarea  class="form-control" name="address"  placeholder="Address"></textarea>
                            <span class="text-danger" id="edit_address_error"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Initial Balance</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="initial_balance"  placeholder="Initial Balance">
                            <span class="text-danger" id="edit_initial_balance_error"></span>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="balance_title">
                                <option disabled selected>--Select Balance Title--</option>
                                <option value="Debit">Debit</option>
                                <option value="Credit">Credit</option>
                            </select>
                            <span class="text-danger" id="edit_balance_title_error"></span>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Update Supplier Info</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
