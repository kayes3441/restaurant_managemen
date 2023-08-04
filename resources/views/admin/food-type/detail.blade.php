
@section('body')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Purchase Product Type Detail Info</h4>
                <h6 class="text-success text-center">{{Session::get('message')}}</h6>
                <table class="table table-bordered">
                    <tr>
                        <th>Purchase Product Type Name</th>
                        <td>{{$purchase_product_type->name}}</td>
                    </tr>
                    <tr>
                        <th>Purchase Product Type Status</th>
                        <td>{{$purchase_product_type->status == 1 ? 'Published' : 'Unpublished'}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
