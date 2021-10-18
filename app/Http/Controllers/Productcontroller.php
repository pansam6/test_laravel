<?php

namespace App\Http\Controllers;

use App\Models\product;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Productcontroller extends Controller
{

    public function product(){
        // $arr = [];
        // $arr["carbon"] = Carbon::now();
        // $arr["carbonadd"] =  $arr["carbon"]->add(1, 'day');
        // $arr["carbonadd2"] =  Carbon::now()->add(1, 'day');
        // $arr["carbonformat"] =  Carbon::createFromFormat('d-mooY', '13-10oo2540');
        // dd(session()->get('user'));
        if(!session()->has('user')) {
            return redirect('login');
        }
        if(session()->has('user')) {
            $products = Product::all();
            return view('welcome', ['products' => $products]);
        }
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
            $product->status = $request->status;
            $product->user_update = $request->user_update;
            $product->save();
            return $request;
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
        $product->user_update = $request->user_update;
        $product->save();
        return $request;
    }
}

