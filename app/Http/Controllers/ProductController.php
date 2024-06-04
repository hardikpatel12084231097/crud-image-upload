<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
public function index()
{
    $products=Product::latest()->get();
    return view('products.list',compact('products'));
}
public function create()
{
return view('products.create');
}
public function store(Request $request)
{
// create validation

$rules=[
    'name'=>'required|min:3',
    'sku'=>'required|min:3',
    'price'=>'required|numeric'
];

if(!empty($request->image))
{
    $rules['image']='image';
}

$validator=Validator::make($request->all(),$rules);

if($validator->fails())
{
    return redirect()->route('products.create')->withInput()->withErrors($validator);
}

// save Record

$products=new Product();
$products->name=$request->name;
$products->sku=$request->sku;
$products->price=$request->price;
$products->description=$request->description;
$products->save();

// store image


if($request->image!='')
{
 $image=$request->image;
 $ext=$image->getClientOriginalExtension();
 $imageName=time().'.'.$ext;

 $image->move(public_path('uploads/products'),$imageName);

 $products->image=$imageName;
 $products->save();
}

return redirect()->route('products.index')->with('success','Product Add Successfully.');

}



public function edit($id)
{
    $products=Product::findOrFail($id);
    return view('products.edit',compact('products'));

}
public function update(Request $request,$id)
{
    $products=Product::findOrFail($id);
    // create validation

$rules=[
    'name'=>'required|min:3',
    'sku'=>'required|min:3',
    'price'=>'required|numeric'
];

if(!empty($request->image))
{
    $rules['image']='image';
}

$validator=Validator::make($request->all(),$rules);

if($validator->fails())
{
    return redirect()->route('products.edit',$products->id)->withInput()->withErrors($validator);
}

// save Record

$products->name=$request->name;
$products->sku=$request->sku;
$products->price=$request->price;
$products->description=$request->description;
$products->save();

// store image


if($request->image!='')
{

// remove old image

 File::delete(public_path('uploads/products/'.$products->image));

 $image=$request->image;
 $ext=$image->getClientOriginalExtension();
 $imageName=time().'.'.$ext;

 $image->move(public_path('uploads/products'),$imageName);

 $products->image=$imageName;
 $products->save();
}

return redirect()->route('products.index')->with('success','Product Update Successfully.');


}
public function destroy($id)
{
    $products=Product::findOrFail($id);
    File::delete(public_path('uploads/products/'.$products->image));
    $products->delete();
    return redirect()->route('products.index')->with('error','Product Deleted Successfully.');

}

}
