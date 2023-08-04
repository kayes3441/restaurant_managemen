<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
</script>
<script>
    // $(document).ready(function (){
    //     $('#addModal form').on('submit',function (e){
    //         e.preventDefault();
    //         $.ajax({
    //             method:$(this).attr('method'),
    //             url:$(this).attr('action'),
    //             data:$('#addFoodForm').serialize(),
    //             success:function (response){
    //                 console.log(response)
    //                 $('#addModal').modal('hide');
    //                 $('#addFoodForm')[0].reset();
    //                 $('#datatable').load(location.href+' #datatable');
    //             }
    //         })
    //     })
    // })


    //Edit Model ...................

    // function editModal(obj){
    //     console.log(obj)
    //     $('#editModal input[name=id]').val(obj.id);
    //     $('#editModal input[name=food_name]').val(obj.food_name);
    //     $('#editModal input[name=code]').val(obj.code);
    //     $('#editModal input[name=price]').val(obj.price);
    //     $('#editModal').modal('show')
    //
    //     $('#editModal form').on('submit',function (u){
    //         u.preventDefault();
    //         $.ajax({
    //             method:$(this).attr('method'),
    //             url   :$(this).attr('action'),
    //             data:$('#editFoodForm').serialize(),
    //             success:function (response){
    //                 console.log(response);
    //                 $('#editModal').modal('hide');
    //                 $('#editFoodForm')[0].reset();
    //                 $('#datatable').load(location.href+' #datatable');
    //             }
    //         })
    //     })
    // }

    // function detailModal(obj){
    //     $('#detailModal input[name=id]').val(obj.id)
    //     $('#detailModal output[name=food_type_name]').val(obj.food_type.name)
    //     $('#detailModal output[name=name]').val(obj.name)
    //     $('#detailModal output[name=code]').val(obj.code);
    //     $('#detailModal output[name=price]').val(obj.price);
    //     $('#detailModal output[name=status]').val(obj.status ==1 ?'Available':'Unavailable');
    //     $('#detailModal').modal('show');
    // }

    function deleteFood(id) {
        confirm("Are You Sure To Delete!!!")&&
        $.get("{{route('delete-food')}}",{id:id},(response)=>{
            if (response !="Not Success")
            {
                $('#table').empty().append(response);
            }
            else
                alert("Can't Delete");
        })
    }
    function actionFood(obj)
    {

        confirm(obj.status==1 ? "Food will be unavailable!!!":"Food will be available")&&
        $.get("{{route('status-food')}}",{id:obj.id,status:obj.status},(response)=>{
            $('#table').empty().append(response);
        })
    }


</script>
