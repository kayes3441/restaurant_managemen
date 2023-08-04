<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
</script>
<script>
    $(document).ready(function () {
        $('#addModal form').on('submit',function (e){
            e.preventDefault();
            console.log();
            $.ajax({
                method:$(this).attr('method'),
                url:$(this).attr('action'),
                data: $('#addForm').serialize(),
                success:function (response)
                {
                    console.log(response)
                    $('#addModal').modal('hide');
                    $('#addForm')[0].reset();
                    $('#datatable').load(location.href+' #datatable');
                }
            })
        })
    });
    function detailModal(obj){

        $('#detailModal output[name=id]').val(obj.id);
        $('#detailModal output[name=name]').val(obj.name);
        $('#detailModal output[name=code]').val(obj.code);
        $('#detailModal output[name=status]').val(obj.status ==1 ?'Published':'Unpublished');
        console.log(obj)
        $('#detailModal').modal('show');
    }
    //edit unit ..............
    function editModal(obj){
        $('#editModal input[name=id]').val(obj.id);
        $('#editModal input[name=name]').val(obj.name);
        $('#editModal input[name=code]').val(obj.code);
        console.log(obj);
        $('#editModal').modal('show');
        $('#editModal form').on('submit',function (u){
            u.preventDefault();
            $.ajax({
                method:$(this).attr('method'),
                url:$(this).attr('action'),
                data: $('#updateForm').serialize(),

                success:function (response)
                {
                    console.log(response)
                    $('#editModal').modal('hide');
                    $('#datatable').load(location.href+' #datatable');
                }
            })
        });
    }

    //delete Unit data .......
    function deleteBank(obj){
        confirm('Are You Sure To Delete!!') &&
        $.get("{{ route('delete.bank') }}",{id:obj.id},(response)=>{
            console.log(response);
            if(response.status=='success')
            {
                $('#datatable').load(location.href+' #datatable');
            }
            if (response=='Not Success'){
                alert("Can't be deleted");
            }



        })
    }



</script>


