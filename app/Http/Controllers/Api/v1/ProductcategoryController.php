<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Productcategory;
use Illuminate\Http\Request;

class ProductcategoryController extends ApiBaseController
{
    //
    public function index(Request $request)
    {
        try {
            $order_key = "created_at";
            $order_direction = "desc";
            if (isset($request->orderBy)) {
                $orders = json_decode($request->orderBy);
                $order_key = $orders->field;
                $order_direction = $request->orderDirection;
            }
            $categories = Productcategory::where(function ($query) use ($request) {
                $query->where("product_category_name", "LIKE", "%{$request->search}%");
                if (isset($request->filters)) {
                    foreach ($request->filters as $key => $fil) {
                        $s_key = json_decode($fil, true)["column"]["field"];
                        $s_val = json_decode($fil, true)["value"];
                        if (gettype($s_val) == "array") {
                            $query->whereIn($s_key, $s_val);
                        } else {
                            $query->where($s_key, "LIKE", "%{$s_val}%");
                        }
                    }
                }
            })->orderBy($order_key, $order_direction)
                ->paginate($request->per_page);
            return $categories;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getValue(Request $request)
    {
        try {
            //return $request;
            return Productcategory::find($request->category_id);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_category_name' => 'required',
            'sort_order' => 'required',
        ]);
        try {
            $product = new Productcategory();
            $product->product_category_name = $request->product_category_name;
            $product->sort_order = $request->sort_order;
            if ($product->save()) {
                return $this->successResponse("Successfully Create Product Category", 200);
            } else {
                return $this->errorData("Failed to Create Product Category", 500);
            }
        } catch (\Exception $e) {
            return $this->errorData("Failed to Create Product Category", 500);
        }
    }
    public function update(Request $request)
    {
        $validateData = $request->validate([
            'product_category_name' => 'required',
            'sort_order' => 'required',

        ]);
        try {
            $product = Productcategory::find($request->id);
            $product->product_category_name = $request->product_category_name;
            $product->sort_order = $request->sort_order;

            //return $request;
            if ($product->save()) {
                return $this->successResponse("Successfully Update Product Category", 200);
            } else {
                return $this->errorData("Failed to Update Product Category", 500);
            }
        } catch (\Exception $e) {
            return $this->errorData("Failed to Update Product Category", 500);
        }
    }

    public function deleteMass(Request $request)
    {
        try {
            $ids = json_decode($request->register_id);
            Productcategory::whereIn('id', $ids)->delete();
            return $this->successResponse("Successfully deleted", 200);
        } catch (\Exception $e) {
            return $this->errorData("failed to delete", 500);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Productcategory::find($id);
            if ($product->delete()) {
                return $this->successResponse("product delete succesfully", 200);
            } else {
                return $this->errorData("Failed to delete product", 500);
            }
        } catch (\Exception $e) {
            //return $e;
            return $this->errorData("Failed to delete product", 500);
        }
    }
}