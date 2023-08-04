<script>
    let index = 0;
    // document.querySelector("#add").addEventListener('click',addItem);
    function addItem(){
        index++;
        let from = $("#from").val();
        let item = '<div class="row item mb-2" style="position:relative;" id="row'+index+'"><button type="button" onclick="deleteItem('+index+')" class="row-delete-btn">&times;</button>'+
            '<div class="col-12"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" style="width: 60px;">To </span></div>'+
            '<select name="unit[]" class="form-control" required>' +
            '<option value="">--Select--</option>'+
            '</select>'+
            '<input type="number" name="factor[]" min="0"  placeholder="Factor" class="form-control" required>'+
            '</div></div></div>';
        if(from){
            $("#items").append(item);
        }

        // else {
        //     alert('From Unit Must Be Selected !!!');
        // }
    }

    function deleteItem(rowIndex){
        $("#row"+rowIndex).remove();
    }
</script>
