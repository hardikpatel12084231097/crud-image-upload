@extends('layouts.app')

@section('content')

{{-- Form Design To store Product --}}

<div class="container">

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{route('products.index')}}" class="btn btn-primary btn-lg">Back</a>
            </div>
            <div class="card">
                <div class="card-header">
                   <h3 class="text-black">Edit Product</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('products.update',$products->id)}}" enctype="multipart/form-data">
                     @csrf
                     @method('put')
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name='name' id="name" placeholder="Enter Product Name" value="{{old('name',$products->name)}}">

                        @error('name')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                      </div>

                    <div class="mb-3">
                        <label for="sku" class="form-label">Sku</label>
                        <input type="text" class="form-control  @error('sku') is-invalid @enderror" name="sku" id="sku" placeholder="Enter Product Sku" value="{{old('sku',$products->sku)}}" >

                        @error('sku')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror

                      </div>
                      <div class="mb-3">
                        <label for="price" class="form-label">Product Price</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" placeholder="Enter Product Price" value="{{old('price',$products->price)}}">

                    
                        @error('price')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror

                      </div>
                      
                      <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{$products->description}}</textarea>
                      </div>

                      <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror " id="image">
                        
                        @if(!empty($products->image))
                        <img src="{{asset('uploads/products/'.$products->image)}}" width="100px" class="my-2">
                        @endif



                        @error('image')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                      </div>

                      <div class="mb-3 d-grid">
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
    
@endsection