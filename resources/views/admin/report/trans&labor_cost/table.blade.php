<table class="table  table-nowrap dataTable no-footer" id="datatable" role="grid" aria-describedby="DataTables_Table_0_info" style="position: relative;">
    <thead>
    <tr>
        <th>sl</th>
        <th>Date</th>
        <th>Type</th>
        <th>Transport Cost</th>
        <th>Labor Cost</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody >
    @php($total_trans_cost=0)
    @php($total_labor_cost=0)
    @php($i=1)
    @foreach($all_cost as $cost)

        @if($cost->transport_cost >0 or $cost->labor_cost>0)
        <tr>
            <td>{{$i++}}</td>
            <td>{{dateFormat($cost->created_at,'Y-m-d')}}</td>
            <td>{{'Purchase'}}</td>

            <td>{{$cost->transport_cost}}</td>
            <td>{{$cost->labor_cost}}</td>

            <td>
                <a  class="btn btn-secondary btn-sm" target="_blank" href="{{route('trans.and.labor.invoice',['id'=>$cost->id])}}">
                    <i class="fa fa-eye"></i>
                </a>
            </td>
        </tr>
        @php($total_trans_cost+=$cost->transport_cost)
        @php($total_labor_cost+=$cost->labor_cost)
        @endif
    @endforeach
    </tbody>
    <tfoot>
    <th colspan="3" class="text-center" rowspan="1">Total:</th>
    <th  rowspan="1" colspan="1" style="width: 78.8125px;">{{$total_trans_cost}}</th>
    <th  rowspan="1" colspan="2" style="width: 92.796875px;">{{$total_labor_cost}}</th>

    </tfoot>
</table>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
</script>
