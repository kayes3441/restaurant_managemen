<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    paymentMedia()
    function getClient()
    {
        // alert('hi')
        var clientType= document.getElementById('clientType');
        if(clientType.value=='Customer')
        {

            var item= document.getElementById('amountTitle');
            item.textContent="Receive"
            $('#amountTitle').text(item.textContent);
            $.get('{{url('get-customer')}}',(response)=>{
                console.log(response)
                var option ='<option value="">--Select--</option>';
                $.each(response,function (key,value){
                    option +='<option value="'+value.id+'">'+value.name+'</option>'
                })
                $('select[name=client_id]').empty().append(option);
            })
        }
        if(clientType.value=='Supplier')
        {
            var item= document.getElementById('amountTitle');
            item.textContent="Payment"
            $('#amountTitle').text(item.textContent);
            $.get('{{url('get-supplier')}}',(response)=>{
                // console.log(response)
                var option ='<option value="">--Select--</option>';
                $.each(response,function (key,value){
                    option +='<option value="'+value.id+'">'+value.name+'</option>'
                })
                $('select[name=client_id]').empty().append(option);
            })
        }
        else {
        }
    }
    function getClientId(id)
    {
        var clientType= document.getElementById('clientType');
        if(clientType.value=='Customer')
        {
            $.get("{{url('get-customer-id')}}",{id:id},(response)=>{
                // console.log(response)
            }).then((response)=>{
                $('input[name=past_balance]').empty().val(response.result.balance);
                $('input[name=new_balance]').empty().val(response.result.balance);
                $('input[name=balance_title]').empty().val(response.result.title);
                $('input[name=new_balance_title]').empty().val(response.result.title);

            })
        }
        if(clientType.value=='Supplier')
        {
            $.get("{{url('get-supplier-id')}}",{id:id},(response)=>{
                console.log(response)
            }).then((response)=>{
                $('input[name=past_balance]').empty().val(response.result.balance);
                $('input[name=new_balance]').empty().val(response.result.balance);
                $('input[name=balance_title]').empty().val(response.result.title);
                $('input[name=new_balance_title]').empty().val(response.result.title);
            })
        }
        else {

        }
    }

    function paymentMedia()
    {
       var media=document.getElementById('mediaId');
       console.log(media.value);
        if(media.value=="Cash")
        {
            $('#account').hide();
        }
       if(media.value=="Bank")
       {
           $('#account').show();
           $.get("{{url('get-bank-account')}}",(response)=>{
               console.log(response)
               var option='<option value="">--Select--</option>';
               $.each(response,function (key,value) {
                   option+='<option value="'+value.id+'">'+value.account_number+'</option>'
               })
               $('select[name=bank_account_id]').empty().append(option);

           })
       }
    }
    function dueCalculate()
    {
        var total=0;
        var balance= Number($('input[name=past_balance]').val());
        var amount= Number($('input[name=amount]').val());

        // total=Math.abs(Number(balance-amount));
        // console.log(total);
        var discount=Number($('input[name=discount]').val());
        var last_total=0;

        // last_total=Math.abs(Number(total-discount));

        var clientType= document.getElementById('clientType');
        var balanceTitle=document.getElementById('balanceTitle');
        if (clientType.value=='Supplier' && balanceTitle.value=='Credit' || clientType.value=='Customer' && balanceTitle.value=='Debit')
        {
            total=Math.abs(Number(balance+amount))
            last_total=Math.abs(Number(total-discount));
        }
        else if(clientType.value=='Supplier' && balanceTitle.value=='Debit' || clientType.value=='Customer' && balanceTitle.value=='Credit')
        {
            total=Math.abs(Number(balance-amount));
            last_total=Math.abs(Number(total-discount));
        }
        // console.log(last_total);
        $('input[name=new_balance]').empty().val(last_total);


        // var balanceTitle=document.getElementById('balanceTitle');
        // if (clientType.value=='Supplier' && balanceTitle.value=='Credit')
        // {
        //     total=Math.abs(Number(balance-amount));
        //     last_total=Math.abs(Number(total-discount));
        // }

        if(clientType.value=='Supplier'){

            if(balance>=amount)
            {
                var item=document.getElementsByClassName('new-balance-title');
                item.textContent="Debit";
                $('input[name=new_balance_title]').val(item.textContent);
            }
            else
            {
                var item=document.getElementsByClassName('new-balance-title');
                item.textContent="Credit";
                $('input[name=new_balance_title]').val(item.textContent);
            }
        }

        if(clientType.value=='Customer'){
            if(balance>=amount)
            {
                var item=document.getElementsByClassName('new-balance-title');
                item.textContent="Credit";
                $('input[name=new_balance_title]').val(item.textContent);
            }
            else
            {
                var item=document.getElementsByClassName('new-balance-title');
                item.textContent="Debit";
                $('input[name=new_balance_title]').val(item.textContent);
            }
        }
    }

    $('#receiveAndPayId form').on('submit',function (e){
        e.preventDefault();
        $.ajax({
            method:$(this).attr('method'),
            url:$(this).attr('action'),
            data:$('#addForm').serialize(),
            success:function (response){
                console.log(response)
                if (response =='success')
                {
                    $('#receiveAndPayId form')[0].reset()
                    Command: toastr["success"]("Complete Payment Successfully", "Success")
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-center",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }

                }
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
</script>
