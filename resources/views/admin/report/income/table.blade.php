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
    @php($total_income=0)
    @foreach($incomes as $income)
        @php($sl=$loop->iteration)
        <tr id="rowId{{$income->id}}">
            <td>{{$sl}}</td>
            <td>{{dateFormat($income->created_at,'Y-m-d')}}</td>
            <td>{{$income->sector->sector_name}}</td>
            <td>{{$income->accountChart->account_name}}</td>
            <td>TK.{{$income->amount}}</td>
            <td>
                <a class="btn btn-secondary btn-sm" target="_blank" href="{{route('income.invoice',['id'=>$income->id])}}"><i class="fa fa-eye"></i></a>
            </td>
        </tr>
        @php($total_income+=$income->amount)
    @endforeach
    </tbody>
    <tfoot>
    <th colspan="4" class="text-center" rowspan="1">Total:</th>
    <th  rowspan="1" colspan="2" style="width: 78.8125px;">{{$total_income}}</th>
    </tfoot>
</table>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
</script>
