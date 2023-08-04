<script src="{{asset('/')}}admin/assets/libs/select2/js/select2.min.js"></script>
<script src="{{asset('/')}}admin/assets/js/pages/form-advanced.init.js"></script>

<script>
    index = {{$count}};
    function getProductId(rowIndex)
    {
        let id = $('#productTypeId'+rowIndex).val();
        var option='<option value="" selected>--Select Product--</option>';
        $.get(("{{url('get-product-id-by-product-type')}}"),{id:id},(response)=>{
            // console.log(response);
            $.each(response,function (key,value){
                option +='<option value="'+value.id+'">'+value.name+'</option>'
            })
            $('#purchaseProductId'+rowIndex).empty().append(option);
        })
    }
    function getProductInfo(rowIndex){
        let id = $('#purchaseProductId'+rowIndex).val();
        console.log(id)
        $.get(("{{url('get-product-detail')}}"),{id:id},(response)=>{
            let total_quantity=0;
            let total_price=0;
            let avg_price=0;
            response.forEach(item=>{
                // console.log(item.price);
                total_quantity +=item.quantity;
                total_price +=item.quantity*item.price;
            })
            // console.log(total_quantity)
            // console.log(total_price)
            avg_price =(total_price/total_quantity);
            // console.log(avg_price);
            $('#avgPrice'+rowIndex).empty().val(avg_price);
        }).then((response)=>{
            $.get("{{url('get-product-info')}}",{id:id},(response)=>{
                // console.log(response)
                $('#unit'+rowIndex).empty().val(response.unit.name);
            })
        })
    }
    {{--function getProductInfo(rowId)--}}
    {{--{--}}
    {{--    $.get("{{url('get-product-info')}}",{id:rowId},(response)=>{--}}
    {{--        // console.log(response)--}}
    {{--    }).then((response)=>{--}}
    {{--        console.log(response.unit_id);--}}
    {{--        $.get("{{url('get-unit-info')}}",{id:response.unit_id},(response)=>{--}}
    {{--            // console.log(response.name)--}}
    {{--            $('#unit'+index).empty().val(response.name);--}}
    {{--        })--}}
    {{--    })--}}
    {{--}--}}
    function multiply(rowIndex){

        let avg_price = Number($('#avgPrice'+rowIndex).val());
        let quantity =Number($('#qty'+rowIndex).val());
        let cost =avg_price*quantity;
        //console.log(cost)
        $('#costId'+rowIndex).empty().val(cost);
    }
    function totalCost(rowIndex)
    {
        let totalCost=0;
        for (let i=1;i<=index;i++){
            let cost =$('#costId'+i).val();
            console.log(cost);
            if(typeof (cost)!="undefined")
            {
                totalCost +=Number(cost);
            }
        }
        $('#totalCostId').empty().val(totalCost);
    }
    function add()
    {
        index++;
        let item ='<div class="product  mx-1 row "  id="inputProduct'+index+'">'+
            '<div class="col-sm-3">'+
            '<div class="input-group mb-3">'+
            '<div class="input-group-prepend">'+
            '<span class="input-group-text" id="option-offset">Product Type</span>'+
            '</div>'+
            '<select class="form-control" name="product_type_id[]" id="productTypeId'+index+'" onchange="getProductId('+index+')">'+
            '<option  selected>--Product Type--</option>'+
            '@foreach($product_types as $product_type)'+
            '<option value="{{$product_type->id}}">{{$product_type->name}}</option>'+
            '@endforeach'+
            '</select>'+
            '</div>'+
            '</div>'+

            '<div class="col-sm-3">'+
            '<div class="input-group mb-3">'+
            '<div class="input-group-prepend">'+
            '<span class="input-group-text" id="option-offset">Product Name</span>'+
            '</div>'+
            '<select class="form-control" name="product_id[]" id="purchaseProductId'+index+'" onchange="getProductInfo('+index+')">'+
            '<option  selected>--Product Name--</option>'+
            '</select>'+
            '</div>'+
            '</div>'+

            '<div class="col-sm-1">'+
            '<input type="text" class="form-control"  id="avgPrice'+index+'"  onkeyup="multiply('+index+')" readonly placeholder="Avg Price"/>'+
            '</div>'+
            '<div class="col-sm-3">'+
            '<div class="input-group mb-3">'+
            '<div class="input-group-prepend">'+
            '<span class="input-group-text" id="option-offset">Quantity</span>'+
            '</div>'+
            '<input type="text" name="quantity[]" id="qty'+index+'" onblur="totalCost('+index+')" onkeyup="multiply('+index+')" class="form-control" />'+
            '<input type="text" class="form-control" name="unit_name[]" id="unit'+index+'" readonly placeholder="Unit"/>'+
            '</div>'+
            '</div>'+

            '<div class="col-sm-1">'+
            '<input type="text" class="form-control" name="cost[]" id="costId'+index+'" placeholder="Cost" readonly>'+
            '</div>'+

            '<div class="row">'+
            '<div class="col-sm-2 ">'+
            '<button  type="button" class="btn btn-danger" style="width:40px;" id="removeId'+index+'" onclick="remove('+index+')">-</button>'+
            '</div>'+
            '</div>'+
            '</div>';
        $('#addRecipe').append(item);
    }
    function remove(removeIndex){
        confirm("Are you sure you want to remove this!!!")&&  $('#inputProduct'+removeIndex).remove();
    }
    function removeRecipe(id)
    {
        confirm('Are You Sure To Delete!!')&&
        $.get("{{ route('delete-recipe') }}",{id:id},(response)=>{
            $('#recipeList'+id).remove();
        })
    }
</script>



