
<div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="min-width: 800px">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="modal_title">Edit Bank Account Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('update.bank-account')}}" method="POST" id="updateForm" >
                    @csrf
                    <input type="hidden" name="id">
                    <input type="hidden" name="sl">
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Bank Name</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="bank_id" >
                                <option disabled selected>--Select Bank--</option>
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}">{{$bank->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="edit_bank_id_error"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Bank Account Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="account_name" placeholder="Bank Account Name">
                            <span class="text-danger" id="edit_account_name_error"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Bank Account Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="account_number" placeholder="Bank Account Number">
                            <span class="text-danger" id="edit_account_number_error"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Contact Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="contact_number" placeholder="Contact Number">
                            <span class="text-danger" id="edit_contact_number_error"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Initial Balance</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="initial_balance" placeholder="Initial Balance">
                            <span class="text-danger" id="edit_initial_balance_error"></span>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="balance_title">
                                <option disabled selected>--Select Balance Title--</option>
                                <option value="Debit">Debit</option>
                                <option value="Credit">Credit</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-email-input" class="col-sm-3 col-form-label">Branch Address</label>
                        <div class="col-sm-9">
                            <textarea  class="form-control" name="branch_address" placeholder="Branch Address"></textarea>
                            <span class="text-danger" id="edit_branch_address_error"></span>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Update Bank Account Info</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
