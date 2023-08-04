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
                data: $('#addForm').serialize(),
                success:function (response)
                {
                    updateData = response.new_product;
                    let table=$('#datatable').DataTable();
                    let sl='<td>'+response.new_product.sl+'</td>';
                    let type='<td>'+response.new_product.purchase_product_type.name+'</td>';
                    let name='<td>'+response.new_product.name+'</td>';
                    let unit='<td>'+response.new_product.unit.name+'</td>';
                    let status ='<td>'+response.new_product.status_title+'</td>';
                    let action='<td>'+
                        '<button type="button" class="btn btn-success btn-sm " style="margin-left: 3px" id="editFormBtn'+response.new_product.id+'" onclick="editAfterUpdate('+response.new_product.id+')">'+
                        '<i class="fa fa-edit"></i> edit'+
                        '</button>'+
                        '<button type="submit" class="btn btn-danger btn-sm" style="margin-left: 3px"  id="deleteBtn'+response.new_product.id+'" onclick="deletePProduct('+response.new_product.id+','+response.new_product.sl+')">'+
                        '<i class="fa fa-trash"></i>delete'+
                        '</button>'+
                        '</td>';
                    table.row.add([sl,type,name,unit,status,action]).draw().data();
                    $('#addModal').modal('hide');
                    $('#addForm')[0].reset();

                },
                error:function (err) {
                    // console.log(err)
                    let error = err.responseJSON;
                    $.each(error.errors, function (index, value) {
                        $("#" + index + "_error").text(value[0]);
                    });
                }

            })
        })
    });
    function editModal(obj,sl)
    {
        data =obj;
        console.log(data)
        editForm(sl);
    }
    function editForm(sl)
    {
        $('#editModal input[name=id]').val(data.id);
        $('#editModal input[name=sl]').val(sl);
        $('#editModal input[name=name]').val(data.name);
        $('#editModal select[name=purchase_product_type_id]').val(data.purchase_product_type_id);
        $('#editModal select[name=unit_id]').val(data.unit_id);
        $('#editModal').modal('show');

    }

    function editAfterUpdate(){
        $('#editModal input[name=id]').val(updateData.id);
        $('#editModal input[name=sl]').val(updateData.sl);
        $('#editModal input[name=name]').val(updateData.name);
        $('#editModal select[name=purchase_product_type_id]').val(updateData.purchase_product_type_id);
        $('#editModal select[name=unit_id]').val(updateData.unit_id);
        $('#editModal').modal('show');
    }

    //edit unit ..............

    $('#editModal form').on('submit',function (u){
        u.preventDefault();
        $.ajax({
            method:$(this).attr('method'),
            url:$(this).attr('action'),
            data: $('#updateForm').serialize(),

            success:function (response)
            {
                updateData = response.edit;
                let table=$("#datatable").DataTable();
                let temp=table.row((response.edit.sl-1)).data();
                temp[0]=response.edit.sl;temp[1]=response.edit.purchase_product_type.name;
                temp[2]=response.edit.name;temp[3]=response.edit.unit.name;
                temp[4]=response.edit.status_title;
                temp[5]=
                    '<button type="button" class="btn btn-success btn-sm " style="margin-left: 3px" id="editFormBtn'+response.edit.id+'" onclick="editAfterUpdate('+response.edit.id+')">'+
                    '<i class="fa fa-edit"></i> edit'+
                    '</button>'+
                    '<button type="submit" class="btn btn-danger btn-sm" style="margin-left: 3px"  id="deleteBtn'+response.edit.id+'" onclick="deleteCustomer('+response.edit.id+','+response.edit.sl+')">'+
                    '<i class="fa fa-trash"></i>delete'+
                    '</button>';
                table.row((response.edit.sl-1)).data(temp).draw();
                $('#editModal').modal('hide');
            },
            error:function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (index, value) {
                    $("#edit_" + index + "_error").text(value[0]);
                });
            }
        })
    });

    //delete Unit data .......
    function deletePProduct(id,sl){
        confirm('Are You Sure To Delete!!')&&
        $.get("{{ route('delete.purchase-product') }}",{id:id,sl:sl},(response)=>{

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


