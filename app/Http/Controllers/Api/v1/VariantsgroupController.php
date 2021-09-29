<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Variant;
use App\Models\Variantgroup;
use Illuminate\Http\Request;

class VariantsgroupController extends ApiBaseController
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
            $variants = VariantGroup::where(function ($query) use ($request) {
                $query->where("variant_group_name", "LIKE", "%{$request->search}%");
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
        return VariantGroup::find($request->variant_id);
    }

    public function getvariants(Request $request)
    {
        $variants = Variant::latest()->get();
        return $variants;
    }
    //
    public function store(Request $request)
    {
        try {
            $variant_group = new Variantgroup();
            $items = array();
            $variants_id = json_decode($request->variants, true);
            foreach ($variants_id as $key => $id) {
                $variant = Variant::find($id);
                array_push($items, $variant);
            }
            $variant_group->variants = json_encode($items);
            $variant_group->variant_group_name = $request->variant_group_name;
            $variant_group->sort_order = $request->sort_order;
            if ($variant_group->save()) {
                return $this->successResponse("VariantGroup Create succesfully", 200);
            } else {
                return $this->errorData("Failed to Create VariantGroup", 500);
            }
        } catch (\Exception $e) {
            //throw $th;
            return $this->errorData("Failed to Create VariantGroup", 500);
        }
    }
    public function update(Request $request)
    {
        try {
            $variant_group = Variantgroup::find($request->variant_group_id);
            $items = array();
            $variants_id = json_decode($request->variants, true);
            foreach ($variants_id as $key => $id) {
                $variant = Variant::find($id);
                array_push($items, $variant);
            }
            $variant_group->variants = json_encode($items);
            $variant_group->variant_group_name = $request->variant_group_name;
            $variant_group->sort_order = $request->sort_order;
            if ($variant_group->save()) {
                return $this->successResponse("VariantGroup Create succesfully", 200);
            } else {
                return $this->errorData("Failed to Create VariantGroup", 500);
            }
        } catch (\Exception $e) {
            //throw $th;
            return $this->errorData("Failed to Create VariantGroup", 500);
        }
    }

    public function deleteMass(Request $request)
    {
        try {
            $ids = json_decode($request->variant_id);
            Variantgroup::whereIn('id', $ids)->delete();
            return $this->successResponse("Successfully deleted", 200);
        } catch (\Exception $e) {
            return $this->errorData("failed to delete", 500);
        }
    }



    public function destroy($id)
    {
        try {
            $variant_group = Variantgroup::find($id);
            if ($variant_group->delete()) {
                return $this->successResponse("VariantGroup delete succesfully", 200);
            } else {
                return $this->errorData("Failed to delete VariantGroup", 500);
            }
        } catch (\Exception $e) {
            //return $e;
            return $this->errorData("Failed to delete VariantGroup", 500);
        }
    }
    public function removeall()
    {
        try {
            //code...
            $variant_group = Variantgroup::truncate();
            return $this->successResponse("All VariantGroup delete succesfully", 200);
        } catch (\Exception $e) {

            return $this->errorData("Failed to delete All VariantGroup", 500);
        }
    }
    /*  public function showall()
{
//dd("hi");
$variant_group = Variantgroup::all();
//return $variant_group;
foreach ($variant_group as $var) {
foreach ($var->variant as $v) {
return $v->variant;
}
}
} */
}
