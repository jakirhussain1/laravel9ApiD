<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products($id=null)
    {
        if($id=="")
        {
            $products = Product::all();
            return response()->json(['products',$products],200);
        }else{
            $product = Product::find($id);
            return response()->json(['product',$product],200);

        }
    }
    public function product(Request $request)
    {
        $request->validate([
            "name"=> "required",
            "description"=> "required",
            "price"=> "required",
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        return response()->json(["Success"=>"Product Added Success"],200);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            "name"=> "required",
            "description"=> "required",
            "price"=> "required",
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->update();
        return response()->json(["Success"=>"Product Updated Success"],200);
    }
    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(["success"=>"Product delete success"]);
    }
}
