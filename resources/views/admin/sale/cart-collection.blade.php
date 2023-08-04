<table class="table table-centered mb-0 table-nowrap" id="">
    <thead class="thead-light">
    <tr>
        <th>Serial</th>
        <th>Food Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th colspan="2">Total</th>
    </tr>
    </thead>
    <tbody id="cartTable">

    @foreach($cartFood as $key=>$food)
        <tr id="rowId{{$key}}">
            <td>{{$loop->iteration}}</td>
            <td>
                <div style="width: 100px; ">
                    <input type="hidden" name="food_id[]" value="{{$food->id}}">
                    <input type="text" class="form-control " style="border: none;"  value="{{$food->name}}"  readonly name="food_name[]">
                </div>
            </td>
            <td>
                <div style="width: 100px;">
                    <input type="text" class="form-control" style="border: none;" id="price{{$key}}" value="{{$food->price}}" name="price[]" readonly>
                </div>
            </td>
            <td>
                <div style="width: 100px;">
                    <input type="number" class="form-control" id="qty{{$key}}" value="{{$food->qty}}" name="quantity[]"  onblur="updateQty('{{$key}}')">
                </div>
            </td>
            <td>
                <div style="width: 100px;">
                    <input type="text" class="form-control total" style="border: none;" value="{{$food->price*$food->qty}}" id="subTotal{{$key}}" readonly name="subTotal[]" onblur="allSubTotal({{$food->id}})">
                </div>
            </td>
            <td>
                <button type="button" class="action-icon text-danger" onclick="removeCart('{{$key}}')">
                    <i class="mdi mdi-trash-can font-size-18"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
