<script>
    $('#dateSubmit form').on('submit',function (e){
        e.preventDefault();
        let start=$('input[name=from]').val();
        let end=$('input[name=to]').val();
        let type=$('input[name=view]').val();
        $.get("{{url('cashbook-info')}}",{start:start,end:end,type:type},(response)=>{
            console.log(response)
            $('#table').empty().append(response);
        })
    })
    $('#startDate').change(()=>{ let startDate = $('#startDate').val(); $('#printStartDate').val(startDate); });
    $('#endDate').change(()=>{ let endDate = $('#endDate').val(); $('#printEndDate').val(endDate); });
</script>
