<?php

namespace App\Http\Controllers;

use App\Models\product;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'date' => 'required'
        ]);
        if ($validator->fails()) {
            return 1;
        } else {
            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->date = $request->date;
            $product->date_update = $request->date_update;
            $product->status = $request->status;
            $product->save();
            return $product;
        }

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
        foreach ($request->check as $id) {
            $product = Product::find($id);
            $product->status = "-10";
            $product->save();
        }
        return $request;
    }

    public function update_productByid(Request $request){
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->date = $request->date;
        $product->date_update = $request->date_update;
        $product->save();
        return 1;
    }
}

