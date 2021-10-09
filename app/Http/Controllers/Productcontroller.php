<?php

namespace App\Http\Controllers;

use App\Models\product;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Productcontroller extends Controller
{
    public function product(){
        $products = Product::all();
        return view('welcome', ['products' => $products]);
    }

    public function get_product() {
        $product = Product::all();
        return $product;
    }

    public function add_product(Request $request){
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->date = $request->date;
        $product->save();
        return $product;
    }

    public function insertproductByid($id) {
        $product = Product::find($id);
        // dd($product);
        return $product;
    }

    public function update_product(Request $request) {
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->date = $request->date;
        $product->save();
        return 1;
    }

    public function delete_product(Request $request) {
        Product::destroy($request->check);
        // foreach ($id as $ids) {
        //     $product = Product::find($ids);
        //     $product->delete();
        // }
        return 1;
    }

    public function update_productByid(Request $request){
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->date = $request->date;
        $product->save();
        return 1;
    }
}

