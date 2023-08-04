<table class="table  table-nowrap dataTable no-footer" id="datatable" role="grid" aria-describedby="DataTables_Table_0_info" style="position: relative;">
    <thead>
    <tr>
        <th>sl</th>
        <th>Date</th>
        <th>Sector Name</th>
        <th>Account</th>
        <th>Amount</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody >
    @php($total_expanses=0)

    @foreach($expanses as $expanse)
        @php($sl=$loop->iteration)
        <tr >
            <td>{{$sl}}</td>
            <td>{{dateFormat($expanse->created_at,'Y-m-d')}}</td>
            <td>{{$expanse->sector->sector_name}}</td>
            <td>{{$expanse->accountChart->account_name}}</td>
            <td>TK.{{$expanse->amount}}</td>
            <td>
                <a class="btn btn-secondary btn-sm" target="_blank" href="{{route('expanse.invoice',['id'=>$expanse->id])}}"><i class="fa fa-eye"></i></a>
            </td>
        </tr>
        @php($total_expanses+=$expanse->amount)
    @endforeach
    </tbody>
    <tfoot>
    <th colspan="4" class="text-center" rowspan="1">Total:</th>
    <th  rowspan="1" colspan="2" style="width: 78.8125px;">{{$total_expanses}}</th>
    </tfoot>
</table>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
</script>
