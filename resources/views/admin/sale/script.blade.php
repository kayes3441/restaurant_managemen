<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="{{asset('/')}}admin/assets/libs/select2/js/select2.min.js"></script>
<script src="{{asset('/')}}admin/assets/js/pages/form-advanced.init.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<script>


    $(document).ready(function() {
        $("#Code").focus();

    });


    $( document ).on( 'keydown', function ( e ) {
        if ( e.keyCode === 36 ) {
            $("#cashPaid").focus();
        }
        else if ( e.keyCode === 33 ) {
            $("#name").focus();
        }
        else if ( e.keyCode === 34 ) {
            $("#mobile").focus();
        }
    });

    var cartCollection = [];
    $(document).ready(function() {
        @foreach($cartFood as $rowId => $food)
        var data={
            'id':'{{$food->id}}',
            'rowId':'{{$food->rowId}}',
            'name':'{{$food->name}}',
            'price':'{{$food->price}}',
            'qty':'{{$food->qty}}',
        }
        cartCollection.push(data);
        @endforeach
        console.log(cartCollection)
    });


    saleType()
    cashPayable()
    function getCustomerId(id)
    {
        $.get(('customer-id'),{id:id},(response)=>{

        }).then((response)=>{
            $('input[name=customer_balance]').empty().val(response.result.balance);
            $('input[name=balance_type]').empty().val(response.result.title);
        })
    }
    allSubTotal();
    VatPercentage();
    //add cart by select
    $('select[name=food_id]').change(()=>{
        let id = $('select[name=food_id]').val();
        if (id){

            $.get("{{ url('add-to-cart') }}",{id:id},(response)=>{
                // console.log(cartCollection);
                let row = null;
                var cart= cartCollection.findIndex(function (object){
                    return object.rowId==response.rowId
                })
                if (cart=='-1') {
                     index++
                    row += '<tr id="rowId' + index + '">' +
                        '<td>' + (cartCollection.length+1) + '</td>' +
                        '<td>' +
                        '<div style="width: 100px; ">' +
                        '<input type="hidden" name="food_id[]" value=' + response.id + '>' +
                        '<input type="text" class="form-control " style="border: none;"  value=' + response.name + '  readonly name="food_name[]">' +
                        '</div>' +
                        '</td>' +
                        '<td >' +
                        '<div style="width: 100px;">' +
                        '<input type="text" class="form-control" id="price' + response.rowId + '" value="' + response.price + '" style="border: none;" name="quantity" readonly>' +
                        ' </div>' +
                        '</td>' +
                        '<td>' +
                        '<div style="width: 100px;">' +
                        '<input type="number" class="form-control" id="qty' + response.rowId + '" value="' + response.qty + '" name="quantity"  onblur="updateQty(\'' + response.rowId + '\')">' +
                        '</div>' +
                        '</td>' +
                        '<td>' +
                        '<div style="width: 100px;">' +
                        '<input type="text" class="form-control total"  value="' + response.price * response.qty + '" style="border: none;"  id="subTotal' + response.rowId + '"  readonly name="subTotal" onblur="allSubTotal(' + response.id + ')">' +
                        '</div>' +
                        '</td>' +
                        '<td>' +
                        '<button type="button" class="action-icon text-danger" onclick="removeCart(\'' + response.rowId + '\');">' +
                        '<i class="mdi mdi-trash-can font-size-18"></i>' +
                        '</button></td>' +
                        '</tr>';
                    var dataR={
                        'id':response.id,
                        'rowId':response.rowId,
                        'name':response.name,
                        'price':response.price,
                        'qty':response.qty,
                    }
                    cartCollection.push(dataR);

                } else {
                    console.log(cart)
                    $('#qty' + response.rowId).val(response.qty);
                    $('#subTotal' + response.rowId).val(response.qty * response.price);
                }

                $('#cartTable').append(row).focus();
                $('select[name=food_id]').val(null).trigger('change.select2');
            }).then(()=>{
                allSubTotal();
                VatPercentage();
            })
        }
    })
    //add cart by code
    index=0

    $('#foodIdByCode form').on('submit',function (e){
        e.preventDefault();
        let code = $('input[name=code]').val();
        let qty = $('input[name=qty]').val();
        console.log();
        $.get("{{url('add-to-cart-by-code')}}",{code:code,qty:qty},(response)=>{
            // console.log(response)
            let row = null;
            var cart= cartCollection.findIndex(function (object){
                return object.rowId==response.rowId
            })
            // console.log(cart)
            if (cart=='-1') {
                index++
                row += '<tr id="rowId' + index + '">' +
                    '<td>'+(cartCollection.length+1)+'</td>'+
                    '<td>' +
                    '<div style="width: 100px; ">' +
                    '<input type="hidden" name="food_id[]" value=' + response.id + '>' +
                    '<input type="text" class="form-control " style="border: none;"  value=' + response.name + '  readonly name="food_name[]">' +
                    '</div>' +
                    '</td>' +
                    '<td >' +
                    '<div style="width: 100px;">' +
                    '<input type="text" class="form-control" id="price' + response.rowId + '" value="' + response.price + '" style="border: none;" name="quantity" readonly>' +
                    ' </div>' +
                    '</td>' +
                    '<td>' +
                    '<div style="width: 100px;">' +
                    '<input type="number" class="form-control" id="qty' + response.rowId + '" value="' + response.qty + '" name="quantity"  onblur="updateQty(\'' + response.rowId + '\')">' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div style="width: 100px;">' +
                    '<input type="text" class="form-control total"  value="' + response.price * response.qty + '" style="border: none;"  id="subTotal' + response.rowId + '"  readonly name="subTotal" onblur="allSubTotal(' + response.id + ')">' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<button type="button" class="action-icon text-danger" onclick="removeCart(\'' + response.rowId + '\');">' +
                    '<i class="mdi mdi-trash-can font-size-18"></i>' +
                    '</button></td>' +
                    '</tr>';

                var dataR={
                    'id':response.id,
                    'rowId':response.rowId,
                    'name':response.name,
                    'price':response.price,
                    'qty':response.qty,
                }
                cartCollection.push(dataR);

            } else {
                console.log(cart)
                $('#qty' + response.rowId).val(response.qty);
                $('#subTotal' + response.rowId).val(response.qty * response.price);
            }
            $('#cartTable').append(row);
            $('input[name=code]').val(null).focus();
            $('input[name=qty]').val(null);

        }).then(()=>{
            allSubTotal();
            VatPercentage();
        })
    })
    //update cart quantity
    function updateQty(id)
    {
        let total=0;
        let qty = $('#qty'+id).val();
        let price = $('#price'+id).val();
        total=Number(qty*price);
        $('#subTotal'+id).val(total);

        $.get("{{url('update-cart')}}",{id:id,qty:qty},(response)=>{
            let row = null;
            console.log(response)
            $.each(response,function (key,value){
                row += '<td>'+
                        '<div style="width: 100px;">'+
                            '<input type="number" class="form-control" id="qty()" value="'+value.qty+'" name="quantity"  onblur="updateQty(\''+key+'\')">'+
                        ' </div>'+
                    '</td>' +
                    '<td>'+
                    '<div style="width: 100px;">'+
                        '<input type="number" class="form-control total"  value="'+value.price*value.qty+'" readonly name="subTotal" onblur="allSubTotal('+value.id+')">'+
                    '</div>'+
                    '</td>' ;
            })
            $('#cartTable').append(row);
        }).then(()=>{
            allSubTotal();
            VatPercentage();
        })

    }
    function removeCart(id)
    {
        $.get("{{route('remove.cart')}}",{id:id},(response)=>{

            console.log(response)
            $('#cartFood').empty().append(response);

            var cartRemove= cartCollection.findIndex(function (object){
                return object.rowId==response.rowId;
            })
            cartCollection.splice(cartRemove);
            // console.log(cartCollection);

        }).then(()=>{
            allSubTotal();
            VatPercentage();
        })
    }
    function allSubTotal(){
        let subtotal=document.getElementsByClassName('total');
        let total=0;
        // console.log(total)
        for(let i=0;i<subtotal.length;i++)
        {
            total +=Number(subtotal[i].value);
        }
        // console.log(total);
        $('input[name=amount]').val(total)
    }
    function VatPercentage()
    {

        let amount=Number($('input[name=amount]').val());
        let vat =Number($('input[name=vat]').val());
        let vatAmount=0;
        vatAmount = (amount*vat)/100;
        $('input[name=vatAmount]').val(vatAmount)

        let subtotal=0;
        subtotal=Number(amount+vatAmount);
        $('input[name=subtotal]').val(subtotal);

        let discount=Number($('input[name=discount]').val());
        let totalPayable=0;
        totalPayable=Number(subtotal-discount);
        $('input[name=totalPayable]').val(totalPayable);
        $('input[name=cashPaid]').val(totalPayable);

    }

    function cashPayable()
    {
        var totalPayable=Number($('input[name=totalPayable]').val());
        let cashPaid=Number($('input[name=cashPaid]').val());
        let changeAmount=0;
        if (cashPaid>totalPayable)
        {
            changeAmount=Number(cashPaid-totalPayable);
        }
        else
        {
            changeAmount=0;
        }
        console.log(changeAmount)
        $('input[name=changeAmount]').empty().val(changeAmount);

    }
    function saleType()
    {
        var title =document.getElementById('sale');

        if(title.value=='Cash'){
            $('#customer').hide();
            $('#balance').hide();
            $('#name').show();
            $('#mobile').show();
        }
        else
        {
            $('#customer').show();
            $('#balance').show();
            $('#name').hide();
            $('#mobile').hide();
        }
    }

    // $('#tableForm form').on('submit',function (e){
    //     e.preventDefault();
    //     $.ajax({
    //         method:$(this).attr('method'),
    //         url:$(this).attr('action'),
    //         data:$('#addForm').serialize(),
    //         success:function (response){
    //             if (response =='success')
    //             {
    //                 $('#tableForm form')[0].reset();
    //                 $('#cartTable').empty();
    //                 // var cartRemove= cartCollection.findIndex(function (object){
    //                 //     return ;
    //                 // });
    //                 // cartCollection;
    //                 // console.log(cartCollection)
    //                 // cartCollection.forEach(function (object){
    //                 //     if(object.rowId==response.rowId){
    //                 //         delete (object.rowId);
    //                 //     }
    //                 // })
    //                 var cartRemove= cartCollection.findIndex(function (object){
    //                     return object.rowId==response.rowId;
    //                 })
    //                 while(cartCollection.length>0)
    //                 {
    //                     cartCollection.pop(cartRemove);
    //                 }
    //                 console.log(cartCollection);
    //                 Command: toastr["success"]("Complete Successfully", "Success")
    //                 toastr.options = {
    //                     "closeButton": false,
    //                     "debug": false,
    //                     "newestOnTop": false,
    //                     "progressBar": true,
    //                     "positionClass": "toast-top-center",
    //                     "preventDuplicates": false,
    //                     "onclick": null,
    //                     "showDuration": "300",
    //                     "hideDuration": "1000",
    //                     "timeOut": "5000",
    //                     "extendedTimeOut": "1000",
    //                     "showEasing": "swing",
    //                     "hideEasing": "linear",
    //                     "showMethod": "fadeIn",
    //                     "hideMethod": "fadeOut"
    //                 }
    //             }
    //
    //         }
    //     })
    // })

    // document.addEventListener('keydown', function (e) {
    //     let key_press = String.fromCharCode(e.keyCode || e.which);
    //     if (key_press=="R"){
    //         annotationType = 'check';
    //         $('.controls button').removeClass('btn-success');
    //         $('#check').addClass('btn-success');
    //     }else if (key_press=="W"){
    //         annotationType = 'cross';
    //         $('.controls button').removeClass('btn-success');
    //         $('#cross').addClass('btn-success');
    //     }else if (key_press=="A"){
    //         annotationType = 'pencil';
    //         $('.controls button').removeClass('btn-success');
    //         $('#pencil').addClass('btn-success');
    //     }else if (key_press=="D"){
    //         annotationType = 'eraser';
    //         $('.controls button').removeClass('btn-success');
    //         $('#eraser').addClass('btn-success');
    //     }else if(key_press=="'"){
    //         $("#next").click();
    //     }else if(key_press=="%"){
    //         $("#previous").click();
    //     }
    // });

    function printInvoice(id)
    {
        // $(window).load(function() {
        //     $('#addModal').modal('show');
        // });
        // alert('hi');
        var data='<input type="button" id="printBtn" class="printPageButton" style="display: block; width=100%; border:none;background-color:#a4d0f8  padding:14px 28px;font-size:16px;cursor:pointer; text-align:center"; value="Print" onclick="window.print()">';
        data+=document.getElementById(id).innerHTML;
        myReceipt=window.open("","myWin","left=150, top=130, width=400,height=500");
        myReceipt.screenX=0;
        myReceipt.screenY=0;
        myReceipt.document.write(data);
        myReceipt.focus();

        setTimeout(()=>{
            myReceipt.close();
        },100000);
    }

</script>

