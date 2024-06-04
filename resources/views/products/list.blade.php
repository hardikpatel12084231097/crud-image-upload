@extends('layouts.app')

@section('content')

{{-- Form Design To store Product --}}

<div class="container">


    @if (Session::has('success'))
    <div class="alert alert-success mb-3">{{Session::get('success')}}</div> 
    @endif

    @if (Session::has('error'))
    <div class="alert alert-danger mb-3">{{Session::get('error')}}</div> 
    @endif


    <div class="row mt-3">
        <div class="col-md-12">


            <div class="d-flex justify-content-end mb-3">
                <a href="{{route('products.create')}}" class="btn btn-primary btn-lg">Create</a>
            </div>

            <div class="card">
                <div class="card-header">
                   <h3 class="text-black">List Product</h3>
                </div>
               <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Sku</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>

                    @if(!empty($products))

                        @foreach ($products as $product )

                        <tr>
                            <td>{{$product->id}}</td>

                            
                            <td>
                                @if(!empty($product->image))
                                <img src="{{asset('uploads/products/'.$product->image)}}" width="100px">
                                @endif
                            </td>
                           
                            <td>{{$product->name}}</td>
                            <td>{{$product->sku}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{\Carbon\Carbon::parse($product->created_at)->format('d M,Y')}}</td>
                            <td>
                            <a href="{{route('products.edit',$product->id)}}" class="btn btn-info">Edit</a>

                            <a href="#" onclick="deleteRecord({{$product->id}})" class="btn btn-danger">Delete</a>

                            <form id="form-delete-{{$product->id}}" method="post" action="{{route('products.destroy',$product->id)}}">
                                @csrf
                            @method('delete')
                            </form>

                            </td>
                        </tr>  
                        @endforeach

                    @else
                    <tr>
                        <td colspan="7">Record Not Found...</td>
                    </tr>

                    @endif


                </table>
               </div>
            </div>
        </div>
    </div>

</div>
    
@endsection

<script>
    function deleteRecord(id)
    {
        if(confirm("Are You Sure Delete.."))
        {
            document.getElementById('form-delete-'+id).submit();
        }
    }
</script>