<table class="table table-editable table-nowrap dataTable no-footer" id="datatable" role="grid" aria-describedby="DataTables_Table_0_info" style="position: relative;">
    <thead>
    <tr>
        <th>sl</th>
        <th>Date</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Product</th>
        <th>Bill</th>
        <th>Paid Amount</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody >
    @php($totalBill=0)
    @php($totalPay=0)
    @foreach($cash_purchases as $cash_purchase)
        @php($sl=$loop->iteration)
        <tr id="rowId{{$cash_purchase->id}}">
            <td>{{$sl}}</td>
            <td>{{dateFormat($cash_purchase->created_at,'Y-m-d')}}</td>
            <td>{{$cash_purchase->name}}</td>
            <td>{{$cash_purchase->mobile}}</td>
            <td>
                @foreach($cash_purchase->details as $detail)
                    {{$detail->product->name}}&nbsp;({{$detail->quantity}}{{$detail->unit_id}}) </br>
                @endforeach
            </td>
            <td>TK.{{$cash_purchase->total_amount}}</td>
            <td>TK.{{$cash_purchase->pay_amount}}</td>
            <td>
                <a target="_blank" class="btn btn-secondary btn-sm" href="{{route('cash.purchase.invoice',['id'=>$cash_purchase->id])}}" >
                    <i class="fa fa-eye"></i>
                </a>
            </td>
        </tr>
        @php($totalBill+=$cash_purchase->total_amount)
        @php($totalPay+=$cash_purchase->pay_amount)
    @endforeach
    </tbody>
    <tfoot>
    <th colspan="5" class="text-center" rowspan="1">Total:</th>
    <th  rowspan="1" colspan="1" style="width: 78.8125px;">{{$totalBill}}</th>
    <th  rowspan="1" colspan="2" style="width: 92.796875px;">{{$totalPay}}</th>
    </tfoot>
</table>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );

</script>
