<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
</script>

<script>

    // Adding a new product purchase type info with ajax......
    data=null; updateData=null;
    console.log(updateData);

    $('#addModalPPType form').on('submit',function (e){
        e.preventDefault();
        console.log();
        $.ajax({
            method:$(this).attr('method'),
            url:$(this).attr('action'),
            data: $('#addForm').serialize(),
            success:function (response)
            {
               // console.log(response.purchase_product_type);
                if(response.process=='add')
                {
                    updateData = response.purchase_product_type;
                    let table=$('#datatable').DataTable();
                    // let row ='<tr id="row_id('+response.id+')" >';
                    let sl ='<td>'+response.purchase_product_type.sl+'</td>';
                    let name='<td>'+response.purchase_product_type.name+'</td>';
                    let status='<td>'+response.purchase_product_type.status_title+'</td>'
                    let action=' <td>'+
                        ' <button type="button" class="btn btn-success btn-sm " id="editFormBtn'+response.purchase_product_type.id+'" onclick="editAfterUpdate('+response.purchase_product_type.id+')">'+
                        '<i class="fa fa-edit"></i> edit'+
                        '</button>'+
                        '<button type="submit" class="btn btn-danger btn-sm" style="margin-left: 3px" id="deleteUnitBtn'+response.purchase_product_type.id+'" onclick="deletePPT('+response.purchase_product_type.id+')">'+
                        '<i class="fa fa-trash"></i>delete'+
                        '</button>'+
                        '</td>';
                    table.row.add([sl,name,status,action]).draw().data();
                    $('#addForm')[0].reset();
                }
                if(response.process=='edit'){
                   console.log(response.purchase_product_type_edit)
                    let table=$("#datatable").DataTable();
                    let temp=table.row((response.purchase_product_type_edit.sl-1)).data();
                    temp[0]=response.purchase_product_type_edit.sl;temp[1]=response.purchase_product_type_edit.name;
                    temp[2]=response.purchase_product_type_edit.status_title;
                    temp[3]= '<button type="button" class="btn btn-success btn-sm " style="margin-left:3px" id="editFormBtn'+response.purchase_product_type_edit.id+'" onclick="editAfterUpdate('+response.purchase_product_type_edit.id+')">'+
                        '<i class="fa fa-edit"></i> edit'+
                        '</button>'+
                        '<button type="submit" class="btn btn-danger btn-sm " style="margin-left:3px" id="deleteUnitBtn'+response.purchase_product_type_edit.id+'" onclick="deleteUnit('+response.purchase_product_type_edit.id+','+response.purchase_product_type_edit.sl+')">'+
                        '<i class="fa fa-trash"></i>delete'+
                        '</button>';
                    table.row((response.purchase_product_type_edit.sl-1)).data(temp).draw();
                    $('#addForm')[0].reset();
                }
            }
        })
    })

    $('#addModalPPType form').on("reset",function (){
        $('#addForm')[0].reset();
    })

    function edit(obj,sl)
    {
        // console.log(sl)
        data =JSON.parse(obj);
        // console.log(data)
        editForm(sl);
    }
    //edit unit ..............
    function editForm(sl){
        $('input[name=name]').val(data.name);
        $('input[name=sl]').val(sl);
        $('input[name=id]').val(data.id);
    }
    function editAfterUpdate(){
        $('input[name=name]').val(updateData.name);
        $('input[name=sl]').val(updateData.sl);
        $('input[name=id]').val(updateData.id);
    }
    //delete Unit data .......
    function deletePPT(id){
        confirm('Are You Sure To Delete!!')&&
        $.get("{{ route('delete') }}",{id:id},(response)=>{
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


