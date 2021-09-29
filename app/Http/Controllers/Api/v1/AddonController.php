<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Addon;
use Illuminate\Http\Request;

class AddonController extends ApiBaseController
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
            $variants = Addon::where(function ($query) use ($request) {
                $query->where("name_addon", "LIKE", "%{$request->search}%");
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

    public function getsingle(Request $request){
        return Addon::find($request->addon_id);
    }


    public function store(Request $request)
    {
        try {
            $items = json_decode($request->items, true);
            foreach ($items as $key => $item) {
                $addon = new Addon();
                $addon->name_addon = $item['addon_name'];
                $addon->price = $item['price'];
                $addon->sort_order = $item['sort_order'];
                $addon->save();
            }
            return $this->successResponse("Successfully create Addons", 200);
        } catch (\Exception $e) {
            return $e;
            return $this->errorData("Failed to create Addons", 500);
        }
    }
    public function update(Request $request)
    {
        try {
                $addon = Addon::find($request->id);
                $addon->name_addon = $request->addon_name;
                $addon->price = $request->price;
                $addon->sort_order = $request->sort_order;
                if ($addon->save()) {
                    return $this->successResponse("Successfully update addon", 200);
                } else {
                    return $this->errorData("Failed to update addon", 500);
                }
        } catch (\Exception $e) {

            return $this->errorData("Failed to update addon", 500);
        }
    }
    public function destroy($id)
    {
        try {
            $addon = Addon::find($id);
            if ($addon->delete()) {
                return $this->successResponse("Addon delete succesfully", 200);
            } else {
                return $this->errorData("Failed to delete Addon", 500);
            }
        } catch (\Exception $e) {
            //return $e;
            return $this->errorData("Failed to delete Addon", 500);
        }
    }


    public function deleteMass(Request $request)
    {
        try {
            $ids = json_decode($request->variant_id);
            Addon::whereIn('id', $ids)->delete();
            return $this->successResponse("Successfully deleted", 200);
        } catch (\Exception $e) {
            return $this->errorData("failed to delete", 500);
        }
    }


    public function removeall()
    {
        try {
            //code...
            $addon = Addon::truncate();
            return $this->successResponse("All Addon delete succesfully", 200);
        } catch (\Exception $e) {

            return $this->errorData("Failed to delete All Addon", 500);
        }
    }
}
