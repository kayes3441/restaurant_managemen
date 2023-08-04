<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );

    {{--$('#dateSubmit form').on('submit',function (e){--}}
    {{--    e.preventDefault();--}}
    {{--    let start=$('input[name=from]').val();--}}
    {{--    let end=$('input[name=to]').val();--}}
    {{--    let type=$('input[name=type]').val();--}}
    {{--    // console.log(start);--}}
    {{--    $.get("{{url('get-purchase-info-by-date')}}",{start:start,end:end,type:type},(response)=>{--}}
    {{--        console.log(response)--}}

    {{--        // $('#table').empty().append(response);--}}
    {{--    })--}}
    {{--})--}}

    $('#dateSubmit form').on('submit',function (e){
        e.preventDefault();
        let start=$('input[name=from]').val();
        let end=$('input[name=to]').val();
        let type=$('input[name=view]').val();
        // console.log(start);
        $.get("{{url('get-purchase-info-by-date')}}",{start:start,end:end,type:type},(response)=>{
            console.log(response)
            $('#table').empty().append(response);

        })
    });

    $('#startDate').change(()=>{ let startDate = $('#startDate').val(); $('#printStartDate').val(startDate); });
    $('#endDate').change(()=>{ let endDate = $('#endDate').val(); $('#printEndDate').val(endDate); });
</script>
