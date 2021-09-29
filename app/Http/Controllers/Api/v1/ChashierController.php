<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Chashier;
use Illuminate\Http\Request;

class ChashierController extends ApiBaseController
{
    //
    public function getSingle(Request $request)
    {
        //dd("hi diwakar");
        //return $request;
        return Chashier::find($request->id);
    }
    public function getAll()
    {
        //dd("hi diwakar");

        return Chashier::all();
    }
    public function store(Request $request)
    {
        try {
            //code...
            $chashier = new Chashier();
            $chashier->chashier_name = $request->chashier_name;
            $chashier->chashier_pin = $request->chashier_pin;
            $chashier->manager_permission = $request->manager_permission;
            if ($chashier->save()) {
                return $this->successResponse("Successfully Created Chashier", 200);
            } else {
                return $this->errorData("Failed to Created Chashier", 500);
            }
        } catch (\Exception $e) {
            //throw $th;
            return $this->errorData("Failed to Created Chashier", 500);
        }
    }
    public function update(Request $request)
    {
        try {
            //code...
            $chashier = Chashier::find($request->id);
            $chashier->chashier_name = $request->chashier_name;
            $chashier->chashier_pin = $request->chashier_pin;
            $chashier->manager_permission = $request->manager_permission;
            //return $chashier;
            if ($chashier->save()) {
                return $this->successResponse("Successfully Update Chashier", 200);
            } else {
                return $this->errorData("Failed to Update Chashier", 500);
            }
        } catch (\Exception $e) {
            //throw $th;
            return $this->errorData("Failed to Update Chashier", 500);
        }
    }
    public function destroy($id)
    {
        try {
            //dd("hi diwakar");
            $chashier = Chashier::find($id);
            if ($chashier->delete()) {
                return $this->successResponse("Chashier delete succesfully", 200);
            } else {
                return $this->errorData("Failed to delete Chashier", 500);
            }
        } catch (\Exception $e) {
            //return $e;
            return $this->errorData("Failed to delete Chashier", 500);
        }
    }
    public function removeall()
    {
        try {
            //code...
            $chashier = Chashier::truncate();
            return $this->successResponse("All Chashier delete succesfully", 200);
        } catch (\Exception $e) {

            return $this->errorData("Failed to delete All Chashier", 500);
        }
    }
}