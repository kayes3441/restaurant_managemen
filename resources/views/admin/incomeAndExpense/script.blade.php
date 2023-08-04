<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $('#sectorId').ready(function ()
    {
        $.get("{{url('get-sector')}}",(response)=>{
            var option= '<option value="">--Select--</option>';

            $.each(response,function (key,value){

                option +='<option value="'+value.id+'">'+value.sector_name+'</option>'
            })
            $('select[name=sector_id]').empty().append(option);
        })
    })
    function sectorToAccount(id)
    {
        $.get("{{url('get-account-name-by-sector-id')}}",{id:id},(response)=>{
            console.log(response);

            var option= '<option value="">--Select--</option>';

            $.each(response,function (key,value){

                option +='<option value="'+value.id+'">'+value.account_name+'</option>'
            })
            $('select[name=account_chart_id]').empty().append(option);
        })
    }
    $('#addForm form').submit(function (e){
        e.preventDefault();
        $.ajax({
            method:$(this).attr('method'),
            url:$(this).attr('action'),
            data:$('#formSubmit').serialize(),
            success:function (response){
                if (response =='success')
                {
                    $('#addForm form')[0].reset()
                    Command: toastr["success"]("Submit Successfully", "Success")
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
                    // var el = $(document).find('[name="'+index+'"]');
                    // el.after($('<span style="color: red;">'+value[0]+'</span>'));
                    // $('.errMsgContainer').append('<span style="color: red;">'+value[0]+'</span>'+'<br>')
                });
            }
        })
    })
</script>
