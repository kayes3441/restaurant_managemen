<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
</script>

<script>

    // Adding a new product purchase type info with ajax......
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

    //edit unit ..............
    function editModal(obj){
        $('#editModal input[name=id]').val(obj.id);
        $('#editModal input[name=name]').val(obj.name);
        $('#editModal').modal('show');
        $('#editModal form').on('submit',function (u){
            u.preventDefault();
            $.ajax({
                method:$(this).attr('method'),
                url:$(this).attr('action'),
                data: $('#updateForm').serialize(),

                success:function (response)
                {
                    $('#editModal').modal('hide');
                    $('#datatable').load(location.href+' #datatable');
                }
            })
        });
    }

    //delete Unit data .......
    function deleteFoodType(obj){
        confirm('Are You Sure To Delete!!')&&
        $.get("{{ route('delete') }}",{id:obj.id},(response)=>{
            console.log(response);

            $('#datatable').load(location.href+' #datatable');
        })
    }

</script>


