<table class="table table-nowrap dataTable no-footer" id="datatable" role="grid" aria-describedby="DataTables_Table_0_info" style="position: relative;">
    <thead>
    <tr>
        <th>Serial</th>
        <th>Sector Name</th>
        <th>Account Name</th>
        <th>Type</th>
        <th>Mobile</th>
        <th>Address</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody id="accountChatTable">
    @foreach($accountCharts as $accountChart)
        @php($sl=$loop->iteration)
        <tr id="rowId{{$accountChart->id}}">
            <td>{{$sl}}</td>
            <td>{{$accountChart->sector->sector_name}}</td>
            <td>{{$accountChart->account_name}}</td>
            <td>{{$accountChart->account_type}}</td>
            <td>{{$accountChart->mobile}}</td>
            <td>{{$accountChart->address}}</td>
            <td>{{$accountChart->status==1 ?'Published': 'Unpublished'}}</td>
            <td>
                <button type="button" class="btn btn-success btn-sm " id="editAccountChat{{ $accountChart->id}}" onclick="edit('{{$accountChart}}','{{$sl}}')">
                    <i class="fa fa-edit"></i> edit
                </button>
                <button type="submit" class="btn btn-danger btn-sm" id="deleteAccountChart{{$accountChart->id}}"  onclick="deleteId('{{$accountChart->id}}')">
                    <i class="fa fa-trash"></i>delete
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
</script>
