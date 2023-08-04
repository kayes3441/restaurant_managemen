<div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="min-width: 800px">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="modal_title">Add Purchase Product  Form Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('create.purchase-product')}}" method="POST" id="addForm" >
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Purchase Product Type Name</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="purchase_product_type_id" >
                                <option disabled selected>--Select Purchase Product Type--</option>
                                @foreach($purchase_product_types as $purchase_product_type)
                                    <option value="{{$purchase_product_type->id}}">{{$purchase_product_type->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger"id="purchase_product_type_id_error"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Purchase Product Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" placeholder="Purchase Product Name">
                            <span class="text-danger"id="name_error"></span>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="unit_id" >
                                <option disabled selected>--Select unit Type--</option>
                                @foreach($units as $unit)
                                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger"id="unit_id_error"></span>
                        </div>
                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Create Purchase Product Info</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


