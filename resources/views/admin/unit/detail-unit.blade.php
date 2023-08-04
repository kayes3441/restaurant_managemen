
<div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="detailModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="min-width: 800px">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Unit Detail Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Unit ID</th>
                        <td><output name="id"></output></td>
                    </tr>
                    <tr>
                        <th>Unit Name</th>
                        <td><output name="name"></output></td>
                    </tr>
                    <tr>
                        <th>Unit Code</th>
                        <td><output name="code"></output></td>
                    </tr>
                    <tr>
                        <th>Unit Description</th>
                        <td><output name="description"></output></td>
                    </tr>
                    <tr>
                        <th>Unit Status</th>
                        <td><output name="status"></output></td>
{{--                        <td>{{$unit->status == 1 ? 'Published' : 'Unpublished'}}</td>--}}
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
