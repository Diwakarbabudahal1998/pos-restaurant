<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Addongroup;
use Illuminate\Http\Request;

class AddongroupController extends ApiBaseController
{
    //
    public function getSingle(Request $request)
    {
        //dd("hi diwakar");
        //return $request;
        return Addongroup::find($request->id);
    }
    public function getAll()
    {
        //dd("hi diwakar");

        return Addongroup::all();
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'addon_group_name' => 'required',
        ]);
        try {
            // dd('hi diwakar');
            //code...
            $addongroup = new Addongroup();
            //$addongroup->user_id = $request->user_id;
            $addongroup->addon_group_name = $request->addon_group_name;
            $addongroup->sort_order = $request->sort_order;
            $addongroup->min_table = $request->min_table;
            $addongroup->max_table = $request->max_table;
            //return $addongroup;
            if ($addongroup->save()) {
                return $this->successResponse("Successfully Create Adon Group", 200);
            } else {
                return $this->errorData("Failed to Create Addon Group", 500);
            }
        } catch (\Exception $e) {
            //throw $th;
            //return $e;
            return $this->errorData("Failed to Create Addon Group", 500);
        }
    }
    public function update(Request $request)
    {
        $validateData = $request->validate([
            'addon_group_name' => 'required',
        ]);
        try {
            //dd('hi diwakar');
            //code...
            $addongroup = Addongroup::find($request->id);
            $addongroup->addon_group_name = $request->addon_group_name;
            $addongroup->sort_order = $request->sort_order;
            $addongroup->min_table = $request->min_table;
            $addongroup->max_table = $request->max_table;
            //return $addongroup;
            if ($addongroup->save()) {
                return $this->successResponse("Successfully Update Adon Group", 200);
            } else {
                return $this->errorData("Failed to Update Addon Group", 500);
            }
        } catch (\Exception $e) {
            //throw $th;
            //return $e;
            return $this->errorData("Failed to Update Addon Group", 500);
        }
    }
    public function destroy($id)
    {
        try {
            $addongroup = Addongroup::find($id);
            if ($addongroup->delete()) {
                return $this->successResponse("Addongroup delete succesfully", 200);
            } else {
                return $this->errorData("Failed to delete Addongroup", 500);
            }
        } catch (\Exception $e) {
            //return $e;
            return $this->errorData("Failed to delete Addongroup", 500);
        }
    }
    public function removeall()
    {
        try {
            //code...
            $addongroup = Addongroup::truncate();
            return $this->successResponse("All Addongroup delete succesfully", 200);
        } catch (\Exception $e) {

            return $this->errorData("Failed to delete All Addongroup", 500);
        }
    }
}