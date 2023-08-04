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
                    updateData = response.account;
                    console.log(updateData);
                    let url = '{{ url('bank-details') }}'+'/'+response.account.id;

                    let table=$('#datatable').DataTable();
                    let sl='<td>'+response.account.sl+'</td>';
                    let bank_name='<td>'+response.account.bank.name+'</td>';
                    let acc_name='<td>'+response.account.account_name+'</td>';
                    let acc_number='<td>'+response.account.account_number+'</td>';
                    let mobile='<td>'+response.account.contact_number+'</td>';
                    let balance ='<td>'+response.account.initial_balance +'</td>';
                    let status ='<td>'+response.account.status_title+'</td>';
                    let action='<td>'+
                        '<a class="btn btn-secondary btn-sm" href="'+url+'"><i class="fa fa-eye"></i></a>'+
                        '<button type="button" class="btn btn-success btn-sm " style="margin-left: 3px" id="editFormBtn'+response.account.id+'" onclick="editAfterUpdate('+response.account.id+')">'+
                        '<i class="fa fa-edit"></i> edit'+
                        '</button>'+
                        '<button type="submit" class="btn btn-danger btn-sm" style="margin-left: 3px"  id="deleteBtn'+response.account.id+'" onclick="deleteBankAccount('+response.account.id+','+response.account.sl+')">'+
                        '<i class="fa fa-trash"></i>delete'+
                        '</button>'+
                        '</td>';
                    table.row.add([sl,bank_name,acc_name,acc_number,mobile,balance,status,action]).draw().data();
                    $('#addModal').modal('hide');
                    $('#addForm')[0].reset();
                },
                error:function (err) {
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
        editForm(sl);
    }
    function editForm(sl){
        $('#editModal input[name=id]').val(data.id);
        $('#editModal input[name=sl]').val(sl);
        $('#editModal select[name=bank_id]').val(data.bank_id);
        $('#editModal input[name=account_name]').val(data.account_name);
        $('#editModal input[name=account_number]').val(data.account_number);
        $('#editModal input[name=contact_number]').val(data.contact_number);
        $('#editModal input[name=initial_balance]').val(data.initial_balance);
        $('#editModal select[name=balance_title]').val(data.balance_title);
        $('#editModal textarea[name=branch_address]').val(data.branch_address);
        $('#editModal').modal('show');
    }
    function editAfterUpdate(){
        $('#editModal input[name=id]').val(updateData.id);
        $('#editModal input[name=sl]').val(updateData.sl);
        $('#editModal select[name=bank_id]').val(updateData.bank_id);
        $('#editModal input[name=account_name]').val(updateData.account_name);
        $('#editModal input[name=account_number]').val(updateData.account_number);
        $('#editModal input[name=contact_number]').val(updateData.contact_number);
        $('#editModal input[name=initial_balance]').val(updateData.initial_balance);
        $('#editModal select[name=balance_title]').val(updateData.balance_title);
        $('#editModal textarea[name=branch_address]').val(updateData.branch_address);
        $('#editModal').modal('show');

    }
    //edit unit ..............
    $('#editModal form').submit(function (e){
        e.preventDefault();
        $.ajax({
            method:$(this).attr('method'),
            url:$(this).attr('action'),
            data: $('#updateForm').serialize(),
                success:function (response)
                {
                    updateData = response.editAccount;
                    let url = '{{ url('bank-details') }}'+'/'+response.editAccount.id;
                    let table=$("#datatable").DataTable();
                    let temp=table.row((response.editAccount.sl-1)).data();
                    temp[0]=response.editAccount.sl;temp[1]=response.editAccount.bank.name;
                    temp[2]=response.editAccount.account_name;temp[3]=response.editAccount.account_number;
                    temp[4]=response.editAccount.contact_number;temp[5]=response.editAccount.initial_balance;
                    temp[6]=response.editAccount.status_title;
                    temp[7]=
                        '<a class="btn btn-secondary btn-sm" href="'+url+'"><i class="fa fa-eye"></i></a>'+
                        '<button type="button" class="btn btn-success btn-sm " style="margin-left: 3px" id="editFormBtn'+response.editAccount.id+'" onclick="editAfterUpdate('+response.editAccount.id+')">'+
                        '<i class="fa fa-edit"></i> edit'+
                        '</button>'+
                        '<button type="submit" class="btn btn-danger btn-sm" style="margin-left: 3px"  id="deleteBtn'+response.editAccount.id+'" onclick="deleteBankAccount('+response.editAccount.id+','+response.editAccount.sl+')">'+
                        '<i class="fa fa-trash"></i>delete'+
                        '</button>';
                    table.row((response.editAccount.sl-1)).data(temp).draw();
                    $('#editModal').modal('hide');
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
    function deleteBankAccount(id,sl){
        confirm('Are You Sure To Delete!!')&&
        $.get("{{ route('delete.bank-account') }}",{id:id,sl:sl},(response)=>{
            // console.log(response);
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
