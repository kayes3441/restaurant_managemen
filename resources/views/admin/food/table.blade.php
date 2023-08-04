<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Serial</th>
        <th>Name</th>
        <th>Code</th>
        <th>Price</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($foods as $food)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$food->food_name}}</td>
            <td>{{$food->code}}</td>
            <td>{{$food->price}}</td>
            <td>{{$food->status ==1 ?'Available':'Unavailable'}}</td>
            <td>
                <a href="{{route('single-food-recipe',['id'=>$food->id])}}" class="btn btn-secondary btn-sm " id="detailBtn{{$food->id}}"  onclick="detailModal({{$food}})">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="{{route('edit-food-recipe',['id'=>$food->id])}}" class="btn btn-primary btn-sm " id="editBtn{{$food->id}}" >
                    <i class="fa fa-edit"></i>
                </a>

                <button type="button" class="btn btn-{{$food->status==1?'success':'warning'}} btn-sm"  id="status{{$food->id}}" onclick="actionFood({{$food}})">
                    <i class="fa fa-arrow-{{$food->status==1?'down':'up'}}"></i>
                </button>

                <button class="btn btn-danger btn-sm " id="delete{{$food->id}}"  onclick="deleteFood({{$food->id}})">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
</script>
