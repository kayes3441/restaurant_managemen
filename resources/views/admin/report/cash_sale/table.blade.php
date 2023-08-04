<table class="table  table-nowrap dataTable no-footer" id="datatable" role="grid" aria-describedby="DataTables_Table_0_info" style="position: relative;">
    <thead>
    <tr>
        <th>sl</th>
        <th>Date</th>
        <th>Customer Name</th>
        <th>Mobile</th>
        <th>Bill</th>
        <th>Discount</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody >
    @php($total_paid=0)
    @php($total_discount=0)
    @foreach($cash_sales as $cash_sale)
        @php($sl=$loop->iteration)
        <tr>
            <td>{{$sl}}</td>
            <td>{{dateFormat($cash_sale->created_at,'Y-m-d')}}</td>
            <td>{{$cash_sale->customer_name}}</td>
            <td>{{$cash_sale->customer_mobile}}</td>
            <td>TK.{{$cash_sale->totalPayable}}</td>
            <td>TK.{{$cash_sale->discount}}</td>
            <td>
                <a class="btn btn-secondary btn-sm" target="_blank" href="{{route('cash.sale.invoice',['id'=>$cash_sale->id])}}"><i class="fa fa-eye"></i></a>
            </td>
        </tr>
        @php($total_paid+=$cash_sale->totalPayable)
        @php($total_discount+=$cash_sale->discount)
    @endforeach
    </tbody>
    <tfoot>
    <th colspan="3" class="text-center" rowspan="1">Total:</th>
    <th  rowspan="1" colspan="1" style="width: 78.8125px;">{{$total_paid}}</th>
    <th  rowspan="1" colspan="2" style="width: 92.796875px;">{{$total_discount}}</th>

    </tfoot>
</table>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
</script>
