<table class="table  table-nowrap dataTable no-footer" id="datatable" role="grid" aria-describedby="DataTables_Table_0_info" style="position: relative;">
    <thead>
    <tr>
        <th>sl</th>
        <th>Date</th>
        <th>Customer Name</th>
        <th>Mobile</th>
        <th>Amount</th>
        <th>Discount</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody >
    @php($total_amount=0)
    @php($total_discount=0)
    @foreach($amounts as $amount)
        @php($sl=$loop->iteration)
        <tr >
            <td>{{$sl}}</td>
            <td>{{dateFormat($amount->created_at,'Y-m-d')}}</td>
            <td>{{$amount->customer->name}}</td>
            <td>{{$amount->customer->mobile}}</td>
            <td>TK.{{$amount->amount}}</td>
            <td>TK.{{$amount->discount}}</td>
            <td>
                <a  class="btn btn-secondary btn-sm" target="_blank" href="{{route('get.receive.invoice',['id'=>$amount->id])}}" >
                    <i class="fa fa-eye"></i>
                </a>
            </td>
        </tr>
        @php($total_amount+=$amount->amount)
        @php($total_discount+=$amount->discount)
    @endforeach
    </tbody>
    <tfoot>
    <th colspan="4" class="text-center" rowspan="1">Total:</th>
    <th  rowspan="1" colspan="1" style="width: 78.8125px;">{{$total_amount}}</th>
    <th  rowspan="1" colspan="2" style="width: 78.8125px;">{{$total_discount}}</th>
    </tfoot>
</table>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
</script>
