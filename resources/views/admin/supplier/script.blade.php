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
            // console.log();
            $.ajax({
                method:$(this).attr('method'),
                url:$(this).attr('action'),
                data: $('#addForm').serialize(),
                success:function (response)
                {
                    console.log(response)
                    updateData = response;
                    // console.log(updateData);
                    let title = response.balance_title;
                    let debit_balance = ''; let credit_balance = '';

                    if (title=='Credit'){
                        credit_balance = response.initial_balance;
                    }else {
                        debit_balance = response.initial_balance;
                    }

                    let url = '{{ url('supplier.detail') }}'+'/'+response.id;
                    // console.log(url);

                    let table=$('#datatable').DataTable();
                    let sl='<td>'+response.sl+'</td>';
                    let name='<td>'+response.name+'</td>';
                    let mobile='<td>'+response.mobile+'</td>';
                    let address='<td>'+response.address+'</td>';
                    let receivable ='<td>'+ credit_balance +'</td>';
                    let payable='<td>'+ debit_balance +'</td>';
                    let status ='<td>'+response.status_title+'</td>';
                    let action='<td>'+
                        '<a class="btn btn-secondary btn-sm" href="'+url+'"><i class="fa fa-eye"></i></a>'+
                        '<button type="button" class="btn btn-success btn-sm " style="margin-left: 3px" id="editFormBtn'+response.id+'" onclick="editAfterUpdate('+response.id+')">'+
                        '<i class="fa fa-edit"></i> edit'+
                        '</button>'+
                        '<button type="submit" class="btn btn-danger btn-sm" style="margin-left: 3px"  id="deleteBtn'+response.id+'" onclick="deleteSupplier('+response.id+','+response.sl+')">'+
                        '<i class="fa fa-trash"></i>delete'+
                        '</button>'+
                        '</td>';
                    table.row.add([sl,name,mobile,address,receivable,payable,status,action]).draw().data();
                    // console.log(response)
                    $('#addModal').modal('hide');
                    $('#addForm')[0].reset();
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
    function detailModal(obj){
        $('#detailModal output[name=id]').val(obj.id);
        $('#detailModal output[name=name]').val(obj.name);
        $('#detailModal output[name=mobile]').val(obj.mobile);
        $('#detailModal output[name=address]').val(obj.address);
        $('#detailModal output[name=initial_balance]').val(obj.initial_balance);
        $('#detailModal output[name=balance_title]').val(obj.balance_title);
        $('#detailModal output[name=status]').val(obj.status ==1 ?'Published':'Unpublished');
        console.log(obj)
        $('#detailModal').modal('show');
    }
    //edit unit ..............
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
        $('#editModal input[name=mobile]').val(data.mobile);
        $('#editModal textarea[name=address]').val(data.address);
        $('#editModal input[name=initial_balance]').val(data.initial_balance);
        $('#editModal select[name=balance_title]').val(data.balance_title);
        $('#editModal').modal('show');
    }
    function editAfterUpdate(){
        $('#editModal input[name=id]').val(updateData.id);
        $('#editModal input[name=sl]').val(updateData.sl);
        $('#editModal input[name=name]').val(updateData.name);
        $('#editModal input[name=mobile]').val(updateData.mobile);
        $('#editModal textarea[name=address]').val(updateData.address);
        $('#editModal input[name=initial_balance]').val(updateData.initial_balance);
        $('#editModal select[name=balance_title]').val(updateData.balance_title);
        $('#editModal').modal('show');
    }

    $('#editModal form').submit(function (e){
        e.preventDefault();
        $.ajax({
            method:$(this).attr('method'),
            url:$(this).attr('action'),
            data: $('#updateForm').serialize(),
            success:function (response)
            {

                updateData = response;
                let title = response.balance_title;
                let debit_balance = ''; let credit_balance = '';

                if (title=='Credit'){
                    credit_balance = response.initial_balance;
                }else {
                    debit_balance = response.initial_balance;
                }
                let url = '{{ url('customer-details') }}'+'/'+response.id;
                let table=$("#datatable").DataTable();
                let temp=table.row((response.sl-1)).data();
                temp[0]=response.sl;temp[1]=response.name;
                temp[2]=response.mobile;temp[3]=response.address;
                temp[4]=credit_balance;temp[5]=debit_balance;
                temp[6]=response.status_title;
                temp[7]=
                    '<a class="btn btn-secondary btn-sm" href="'+url+'"><i class="fa fa-eye"></i></a>'+
                    '<button type="button" class="btn btn-success btn-sm " style="margin-left: 3px" id="editFormBtn'+response.id+'" onclick="editAfterUpdate('+response.id+')">'+
                    '<i class="fa fa-edit"></i> edit'+
                    '</button>'+
                    '<button type="submit" class="btn btn-danger btn-sm" style="margin-left: 3px"  id="deleteBtn'+response.id+'" onclick="deleteCustomer('+response.id+','+response.sl+')">'+
                    '<i class="fa fa-trash"></i>delete'+
                    '</button>';
                table.row((response.sl-1)).data(temp).draw();
                $('#editModal').modal('hide');
            }, error:function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (index, value) {
                    $("#edit_" + index + "_error").text(value[0]);
                });
            }

        })


    })
    //delete Unit data .......
    function deleteSupplier(id,sl){
        confirm('Are You Sure To Delete!!')&&
        $.get("{{ route('delete.supplier') }}",{id:id,sl:sl},(response)=>{
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


