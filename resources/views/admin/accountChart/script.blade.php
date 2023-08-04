<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
</script>
<script>
    $(document).on('change',function ()
    {
        var sector =document.getElementById('sector_id');

        if(sector.value=='new')
        {
            $('#newSectorName').show();
        }
        if(sector.value!='new')
        {
            $('#newSectorName').hide();
        }
    })

    // index=0;
    data=null; updateData=null;
    console.log(updateData);
    $(document).ready(function () {
        $('#addForm form').on('submit',function (e){
            e.preventDefault();
            // console.log(e)
            $.ajax({
                method:$(this).attr('method'),
                url:$(this).attr('action'),
                data: $('#formSubmit').serialize(),
                success:function (response)
                {

                    if(response.process=='add')
                    {
                        updateData = response.accountChart;
                        console.log(response.accountChart);
                        let table=$('#datatable').DataTable();
                        let sl ='<td>'+response.accountChart.sl+'</td>';
                        let sector_name='<td>'+response.accountChart.sector.sector_name+'</td>';
                        let account_name='<td>'+response.accountChart.account_name+'</td>';
                        let account_type='<td>'+response.accountChart.account_type+'</td>';
                        let mobile='<td>'+response.accountChart.mobile+'</td>';
                        let address='<td>'+response.accountChart.address+'</td>';
                        let status='<td>'+response.accountChart.status_title+'</td>'
                        let action=' <td>'+
                            '<button type="button" class="btn btn-success btn-sm "  id="editAccountChat'+response.id+'" onclick="editAfterUpdate('+response.accountChart.id+')">'+
                            '<i class="fa fa-edit"></i> edit'+
                            '</button>'+
                            '<button type="submit" class="btn btn-danger btn-sm" style="margin-left:3px" id="deleteAccountChart'+response.id+'"  onclick="deleteId('+response.accountChart.id+')">'+
                            '<i class="fa fa-trash"></i>delete'+
                            '</button>'+
                            '</td>';
                        table.row.add([sl,sector_name,account_name,account_type,mobile,address,status,action]).draw().data();
                        $('#formSubmit')[0].reset();
                    }

                    if(response.process=='edit'){
                        updateData = response.accountChartEdit;
                        let table=$("#datatable").DataTable();
                        let temp=table.row((response.accountChartEdit.sl-1)).data();
                        temp[0]=response.accountChartEdit.sl;temp[1]=response.accountChartEdit.sector.sector_name;
                        temp[2]=response.accountChartEdit.account_name;
                        temp[3]=response.accountChartEdit.account_type;
                        temp[4]=response.accountChartEdit.mobile;
                        temp[5]=response.accountChartEdit.address;
                        temp[6]=response.accountChartEdit.status_title;
                        temp[7]= '<button type="button" class="btn btn-success btn-sm " style="margin-left:3px" id="editFormBtn'+response.accountChartEdit.id+'" onclick="editAfterUpdate('+response.accountChartEdit.id+')">'+
                            '<i class="fa fa-edit"></i> edit'+
                            '</button>'+
                            '<button type="submit" class="btn btn-danger btn-sm " style="margin-left:3px" id="deleteUnitBtn'+response.accountChartEdit.id+'" onclick="deleteUnit('+response.accountChartEdit.id+','+response.accountChartEdit.sl+')">'+
                            '<i class="fa fa-trash"></i>delete'+
                            '</button>';
                        table.row((response.accountChartEdit.sl-1)).data(temp).draw();
                        $('#formSubmit')[0].reset();
                    }
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

    $('#addForm form').on("reset",function (){
        $('#formSubmit')[0].reset();
    })
    function edit(obj,sl)
    {
        // console.log(obj);
        data =JSON.parse(obj);
        editForm(sl);
    }
    //edit unit ..............
    function editForm(sl){
        $('input[name=id]').val(data.id);
        $('select[name=sector_id]').val(data.sector.id);
        $('input[name=account_name]').val(data.account_name);
        $('select[name=account_type]').val(data.account_type);
        $('input[name=sl]').val(sl);
        $('input[name=mobile]').val(data.mobile);
        $('input[name=address]').val(data.address);
    }
    function editAfterUpdate(){
        $('input[name=id]').val(updateData.id);
        $('select[name=sector_id]').val(updateData.sector.id);
        $('input[name=account_name]').val(updateData.account_name);
        $('select[name=account_type]').val(updateData.account_type);
        $('input[name=sl]').val(updateData.sl);
        $('input[name=mobile]').val(updateData.mobile);
        $('input[name=address]').val(updateData.address);
    }
    function deleteId(id)
    {
        // console.log(id)
        confirm('Are you Sure to Delete!!')&&
        $.get("{{ url('delete-accountChart')}}",{id:id},(response)=>{
            if (response!="Not Success")
            {
                $('#table').empty().append(response);
            }
            if(response =='Not Success'){
                alert("Can't be deleted")
            }

        })
    }

</script>
