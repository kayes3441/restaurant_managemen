<div class="card-body">
    <h4 class="card-title">Manage Purchase Product Type Datatable</h4>
    <table class="table table-nowrap dataTable no-footer" id="datatable" role="grid" aria-describedby="DataTables_Table_0_info" style="position: relative;">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach($purchase_product_types as $purchase_product_type)
            @php($sl=$loop->iteration)
            <tr id="row_id{{$purchase_product_type->id}}" >
                <td>{{$sl}}</td>
                <td>{{$purchase_product_type->name}}</td>
                <td>{{$purchase_product_type->status ==1 ?'Published':'Unpublished'}}</td>
                <td>
                    <button type="button" class="btn btn-success btn-sm " id="editFormBtn{{$purchase_product_type->id}}" onclick="edit('{{ $purchase_product_type }}','{{$sl}}')">
                        <i class="fa fa-edit"></i> edit
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm"  id="deleteUnitBtn{{$purchase_product_type->id}}" onclick="deletePPT({{$purchase_product_type->id}})">
                        <i class="fa fa-trash"></i>delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
</script>
