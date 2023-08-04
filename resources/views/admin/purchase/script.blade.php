<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    //get supplier Details .....
    paymentMedia();
    balanceT();
    function getSupplierId(id)
    {
        $.get(('get-supplier-id'),{id:id},(response)=>{
            console.log(response)
        }).then((response)=>{
            $('output[name=show_amount]').empty().text(response.result.balance);
            $('output[name=show_balance_title]').empty().text(response.result.title);
        })
    }
    //Get Product from product Type
    index =0
    function getProductId(rowIndex)
    {
        let id = $('#productTypeId'+rowIndex).val();
        var option='<option value="" selected>--Select Product--</option>';
        $.get(('get-product-id-by-product-type'),{id:id},(response)=>{
            console.log(response);
            $.each(response,function (key,value){
                option +='<option value="'+value.id+'">'+value.name+'</option>'
            })
            $('#purchaseProductId'+rowIndex).empty().append(option);

    })
    }

    function getProductInfo(rowIndex)
    {
       let id=$('#purchaseProductId'+rowIndex).val();
       // console.log(id)
        $.get("{{url('get-product-info')}}",{id:id},(response)=>{
            console.log(response.unit.name)
            $('#unit'+rowIndex).empty().val(response.unit.name);
        })
    }

    //Multiply Price And Quantity ......
    function multiply(rowIndex)
    {
        var subtotal=0;
        var price =Number($('#price'+rowIndex).val());
        var quantity =Number($('#qty'+rowIndex).val());
        var subTotal =price*quantity;
        // console.log(subTotal);
        $('#subTotal'+rowIndex).val(subTotal)
    }

    //Add All Sub Total .....
    function allSubTotal(){
        let total=0;
        for( let i=1;i<=index;i++) {
            var subTotal = $('#subTotal'+i).val();
            total += Number(subTotal);
        }
        $('input[name=total_amount]').empty().val(total)
        $('input[name=pay_amount]').empty().val(total)
    }

    //Add Multiple Div.....
    function addMore(){
        index ++;
        let item='<div class="form-group row mb-1 mt-2" id="inputProduct'+index+'">'+
            '<div class="col-sm-3" >'+
            '<div class="input-group mb-3" >'+
            '<div class="input-group-prepend">'+
            '<span class="input-group-text" id="option-offset">Type</span>'+
    '</div>'+
        '<select class="form-control" name="product_type_id[]" id="productTypeId'+index+'" onchange="getProductId('+index+')">'+
            '<option value="" selected>--Select Product Type--</option>'+
            @foreach($product_types as $product_type)
           ' <option value="{{$product_type->id}}">{{$product_type->name}}</option>'+
            @endforeach
        '</select>'+
    '</div>'+
    '</div>'+
        '<div class="col-sm-3" >'+
            '<div class="input-group mb-3" >'+
                '<div class="input-group-prepend">'+
                    '<span class="input-group-text" id="option-offset">Product</span>'+
                '</div>'+
                '<select class="form-control" name="product_id[]" onchange="getProductInfo('+index+')" id="purchaseProductId'+index+'" >'+
                    '<option disabled selected>--Select Product--</option>'+
                '</select>'+
            '</div>'+
        '</div>'+
        '<div class="col-sm-2" >'+
            '<div class="input-group mb-3" >'+
                '<input type="number" class="form-control" name="quantity[]" id="qty'+index+'" onkeyup="multiply('+index+')" onblur="allSubTotal()" min="1" placeholder="Quantity">'+
                    '<input type="text"  class="form-control" name=unit_id[] id="unit'+index+'" placeholder="unit" readonly>'+
            '</div>'+
        '</div>'+
        '<div class="col-sm-2" >'+
            '<div class="input-group mb-3" >'+
                '<div class="input-group-prepend">'+
                    '<span class="input-group-text" id="option-offset">Price</span>'+
                '</div>'+
                '<input type="number" class="form-control" name="price[]" id="price'+index+'"  onblur="allSubTotal()" onkeyup="multiply('+index+')" min="1" placeholder="Rate">'+
            '</div>'+
        '</div>'+
        '<div class="col-sm-2" >'+
            '<div class="input-group mb-3" >'+
                '<input type="text" class="form-control" name="sub_total[]" id="subTotal'+index+'" readonly placeholder="SubTotal">'+
                '<button  type="button" class="btn btn-danger" id="removeId'+index+'" onclick="remove('+index+')">X</button>'+
           ' </div>'+
        '</div>'+
    '</div>';



        $('#inputProduct').append(item);
    }

    function remove(removeIndex){
        confirm("Are you sure you want to remove this!!!")&&  $('#inputProduct'+removeIndex).remove();
    }

    //Div Show and Hide
    function balanceT()
    {
        var title=document.getElementById('balanceTitle');
        if(title.value=='Debit')
        {
            $('select[name=supplier_id]').val(null);
            $('output[name="show_amount"]').val(null);
            $('output[name="show_balance_title"]').val(null);

            $('#supplierId').hide();
            $('#supplierAmount').hide();
            $('#cashPayment').show();

            // $('#payableAmount').setAttribute().Method:readonly();
            document.getElementById("payableAmount").readOnly = true;

        }
        else
        {
            $('input[name=name]').val(null);
            $('input[name=mobile]').val(null);

            $('#supplierId').show();
            $('#supplierAmount').show();
            $('#cashPayment').hide();

            document.getElementById("payableAmount").readOnly = false;

        }
    }
    function paymentMedia()
    {
        var title=document.getElementById('paymentMediaId');
        if(title.value=='Debit')
        {
            $('#bankAccount').hide();
        }
        else
        {
            $('#bankAccount').show();
        }
    }



    // $(document).ready(function (){
    //     $('#purchaseForm form').on('submit',function (e){
    //         e.preventDefault();
    //         $.ajax({
    //             method:$(this).attr('method'),
    //             url:$(this).attr('action'),
    //             data:$('#addForm').serialize(),
    //             success:(function (response){
    //                 if (response =='success')
    //                 {
    //                     $('#purchaseForm form')[0].reset()
    //                     $('#inputProduct').empty();
    //                     Command: toastr["success"]("Purchase Completed", "Success")
    //                     toastr.options = {
    //                         "closeButton": false,
    //                         "debug": false,
    //                         "newestOnTop": false,
    //                         "progressBar": true,
    //                         "positionClass": "toast-top-center",
    //                         "preventDuplicates": false,
    //                         "onclick": null,
    //                         "showDuration": "300",
    //                         "hideDuration": "1000",
    //                         "timeOut": "5000",
    //                         "extendedTimeOut": "1000",
    //                         "showEasing": "swing",
    //                         "hideEasing": "linear",
    //                         "showMethod": "fadeIn",
    //                         "hideMethod": "fadeOut"
    //                     }
    //                 }
    //             })
    //         })
    //     })
    // })
</script>
