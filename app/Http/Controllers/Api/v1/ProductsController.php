<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Productcategory;
use Illuminate\Http\Request;

class ProductsController extends ApiBaseController
{
    //
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'price' => 'required',
            'product_name' => 'required',
        ]);
        try {
            //dd('hi diwakar');
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->tax_group_id = $request->tax_group_id;
            $product->category_id = $request->category_id;
            if ($product->save()) {
                return $this->successResponse("Successfully Create Product", 200);
            } else {
                return $this->errorData("Failed to Create Product", 500);
            }
        } catch (\Exception $e) {
            return $this->errorData("Failed to Create Product", 500);
        }
    }
    /* public function relationtest(Request $request)
    {
        $pr = Product::with('productcategory', 'taxgroup')->get();
        // $pr = Product::with('productcategory')->get();
        return $pr;
        foreach ($pr as $p) {
            return $p->productcategory->product_category_name;
        }
    } */
    public function getsingle(Request $request)
    {
        return Product::find($request->product_id);
    }
}