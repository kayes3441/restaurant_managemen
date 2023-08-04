<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
</script>
<script>

    data=null; updateData=null;
    $(document).ready(function () {
        $('#addModal form').on('submit',function (e){
            e.preventDefault();
            console.log();
            $.ajax({
                method:$(this).attr('method'),
                url:$(this).attr('action'),
                data: $('#addUnitForm').serialize(),
                success:function (response)
                {
                    updateData = response;
                    console.log(updateData)
                    let table=$('#datatable').DataTable();
                    let sl='<td>'+response.sl+'</td>';
                    let name='<td>'+response.name+'</td>';
                    let code='<td>'+response.code+'</td>';
                    let description='<td>'+response.description+'</td>';
                    let status ='<td>'+response.status_title+'</td>';
                    let action='<td>'+
                        '<button type="button" class="btn btn-success btn-sm " style="margin-left: 3px" id="editFormBtn'+response.id+'" onclick="editAfterUpdate('+response.id+')">'+
                            '<i class="fa fa-edit"></i> edit'+
                        '</button>'+
                        '<button type="submit" class="btn btn-danger btn-sm " style="margin-left: 3px" id="deleteUnitBtn'+response.id+'" onclick="deleteUnit('+response.id+','+response.sl+')">'+
                            '<i class="fa fa-trash"></i>delete'+
                        '</button>'+
                        '</td>';
                    table.row.add([sl,name,code,description,status,action]).draw().data();
                    $('#addModal').modal('hide');
                    $('#addUnitForm')[0].reset();
                },
                error:function (err) {
                    // console.log(err)
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, value) {
                        $("#" + index + "_error").text(value[0]);
                        // var el = $(document).find('[name="'+index+'"]');
                        // el.after($('<span style="color: red;">'+value[0]+'</span>'));
                        // $('.errMsgContainer').append('<span style="color: red;">'+value[0]+'</span>'+'<br>')
                    });
                }
            })
        })
    });

    function editModal(obj,sl)
    {
        data =JSON.parse(obj);
        editForm(sl);
    }
    {{--function detailModal(id){--}}
    {{--    console.log(id)--}}
    {{--    // $('#detailModal td[id]').val(obj.id);--}}
    {{--    $.get('{{url('get-unit-info')}}',{id:id},(response)=>{--}}
    {{--        $('#detailModal output[name=id]').val(response.id);--}}
    {{--        $('#detailModal output[name=name]').val(response.name);--}}
    {{--        $('#detailModal output[name=code]').val(response.code);--}}
    {{--        $('#detailModal output[name=description]').val(response.description);--}}
    {{--        $('#detailModal output[name=status]').val(response.status== 1 ? 'Published':'Unpublished');--}}
    {{--        $('#detailModal').modal('show');--}}
    {{--    })--}}

    {{--}--}}
    //edit unit ..............

    function editForm(sl)
    {
        $('#editModal input[name=id]').val(data.id);
        $('#editModal input[name=sl]').val(sl);
        $('#editModal input[name=name]').val(data.name);
        $('#editModal input[name=code]').val(data.code);
        $('#editModal textarea[name=description]').val(data.description);
        $('#editModal').modal('show');
    }
    function editAfterUpdate(){
        $('#editModal input[name=id]').val(updateData.id);
        $('#editModal input[name=sl]').val(updateData.sl);
        $('#editModal input[name=name]').val(updateData.name);
        $('#editModal input[name=code]').val(updateData.code);
        $('#editModal textarea[name=description]').val(updateData.description);
        $('#editModal').modal('show');
    }

    $('#editModal form').submit(function (e){
        e.preventDefault();
        $.ajax({
            method:$(this).attr('method'),
            url:$(this).attr('action'),
            data: $('#updateUnitForm').serialize(),
            success:function (response)
            {
                updateData = response;
                let table=$("#datatable").DataTable();
                let temp=table.row((response.sl-1)).data();
                temp[0]=response.sl;temp[1]=response.name;
                temp[2]=response.code;temp[3]=response.description;
                temp[4]=response.status_title;
                temp[5]=
                    '<button type="button" class="btn btn-success btn-sm " style="margin-left: 3px" id="editFormBtn'+response.id+'" onclick="editAfterUpdate()">'+
                    '<i class="fa fa-edit"></i> edit'+
                    '</button>'+
                    '<button type="submit" class="btn btn-danger btn-sm " style="margin-left: 3px" id="deleteUnitBtn'+response.id+'" onclick="deleteUnit('+response.id+','+response.sl+')">'+
                    '<i class="fa fa-trash"></i>delete'+
                    '</button>';
                table.row((response.sl-1)).data(temp).draw();
                $('#editModal').modal('hide');
                // $('#datatable').load(location.href+' #datatable');
            },
            error:function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (index, value) {
                    $("#edit_" + index + "_error").text(value[0]);
                });
            }
        })


    })

    //delete Unit data .......
    function deleteUnit(id,sl){
        confirm('Are You Sure To Delete!!')&&
        $.get("{{ route('delete.unit') }}",{id:id,sl:sl},(response)=>{
            console.log(response);
            // $('#datatable').load(location.href+' #datatable');
            if(response.status=='success')
            {
                let table=$('#datatable').DataTable();
                table.row((sl-1)).remove().draw();
            }
            if (response=='Not Success'){
                alert("Can't be deleted");
            }

        })
    }
</script>

