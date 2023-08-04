
<div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="min-width: 800px">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="modal_title">Add Unit Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('create.unit')}}" method="POST" id="addUnitForm">
                    @csrf
                    <div class="form-group row mb-1">
                        <div class="input-group mb-3 ">
                        <div class="input-group-prepend ">
                            <span class="input-group-text" style="width: 140px" id="option-offset">Unit Name</span>
                        </div>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">

                        </div>
                        <span class="text-danger"id="name_error"></span>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="input-group mb-3 ">
                            <div class="input-group-prepend ">
                                <span class="input-group-text"  style="width: 140px" id="option-offset">Unit Code</span>
                            </div>
                            <input type="text" class="form-control" name="code" id="code" placeholder="code">
                        </div>
                        <span class="text-danger"id="code_error"></span>
                    </div>
                    <div class="form-group row mb-1">
                        <div class="input-group mb-3 ">
                            <div class="input-group-prepend ">
                                <span class="input-group-text"  style="width: 140px"  id="option-offset">Description</span>
                            </div>
                            <textarea  class="form-control" name="description" id="description" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-md-12" style="padding-left:0px">
                            <div class="input-group-prepend ">
                                <button type="submit" class="btn btn-primary w-md addUnit"style="width: 140px"  id="btnId">Create Unit Info</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
