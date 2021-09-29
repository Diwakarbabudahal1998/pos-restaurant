<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Variant;
use Illuminate\Http\Request;

class VariantsController extends ApiBaseController
{
    public function getall(Request $request)
    {
        try {
            $order_key = "created_at";
            $order_direction = "desc";
            if (isset($request->orderBy)) {
                $orders = json_decode($request->orderBy);
                $order_key = $orders->field;
                $order_direction = $request->orderDirection;
            }
            $variants = Variant::where(function ($query) use ($request) {
                $query->where("name_variant", "LIKE", "%{$request->search}%");
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
            return $variants;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getsingle(Request $request)
    {
        return Variant::find($request->variant_id);
    }

    public function store(Request $request)
    {
        try {
            $items = json_decode($request->items, true);
            foreach ($items as $key => $item) {
                $variant = new Variant();
                $variant->name_variant = $item['variant_name'];
                $variant->comment = $item['comment'];
                $variant->price = $item['price'];
                $variant->sort_order = $item['sort_order'];
                $variant->save();
            }
            return $this->successResponse("Successfully create variant", 200);
        } catch (\Exception $e) {
            return $e;
            return $this->errorData("Failed to create variant", 500);
        }
    }
    public function update(Request $request)
    {
        try {
            $variant = Variant::find($request->variant_id);
            $variant->name_variant = $request->variant_name;
            $variant->price = $request->price;
            $variant->comment = $request->comment;
            $variant->sort_order = $request->sort_order;
            if ($variant->save()) {
                return $this->successResponse("Successfully update variant", 200);
            } else {
                return $this->errorData("Failed to update variant", 500);
            }
        } catch (\Exception $e) {
            return $this->errorData("Failed to update variant", 500);
        }
    }
    public function destroy($id)
    {
        try {
            $variant = Variant::find($id);
            if ($variant->delete()) {
                return $this->successResponse("variant delete succesfully", 200);
            } else {
                return $this->errorData("Failed to delete variant", 500);
            }
        } catch (\Exception $e) {
            //return $e;
            return $this->errorData("Failed to delete variant", 500);
        }
    }

    public function deleteMass(Request $request)
    {
        try {
            $ids = json_decode($request->variant_id);
            Variant::whereIn('id', $ids)->delete();
            return $this->successResponse("Successfully deleted", 200);
        } catch (\Exception $e) {
            return $this->errorData("failed to delete", 500);
        }
    }

    public function removeall()
    {
        try {
            //code...
            $variant = Variant::truncate();
            return $this->successResponse("All variant delete succesfully", 200);
        } catch (\Exception $e) {

            return $this->errorData("Failed to delete All variant", 500);
        }
    }
}