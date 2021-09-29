<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Kitchenuser;
use Illuminate\Http\Request;

class KitchenuserController extends ApiBaseController
{
    //
    public function getSingle(Request $request)
    {
        //dd("hi diwakar");
        //return $request;
        return Kitchenuser::find($request->id);
    }
    public function getAll()
    {
        //dd("hi diwakar");

        return Kitchenuser::all();
    }
    public function store(Request $request)
    {
        try {
            //code...
            $kitchenuser = new Kitchenuser();
            $kitchenuser->kitchen_user_name = $request->kitchen_user_name;
            $kitchenuser->kitchen_pin = $request->kitchen_pin;
            if ($kitchenuser->save()) {
                return $this->successResponse("Successfully Created Kitchenuser", 200);
            } else {
                return $this->errorData("Failed to Created Kitchenuser", 500);
            }
        } catch (\Exception $e) {
            //throw $th;
            return $this->errorData("Failed to Created Kitchenuser", 500);
        }
    }
    public function update(Request $request)
    {
        try {
            //code...
            $kitchenuser = Kitchenuser::find($request->id);
            $kitchenuser->kitchen_user_name = $request->kitchen_user_name;
            $kitchenuser->kitchen_pin = $request->kitchen_pin;
            if ($kitchenuser->save()) {
                return $this->successResponse("Successfully Update Kitchenuser", 200);
            } else {
                return $this->errorData("Failed to Update Kitchenuser", 500);
            }
        } catch (\Exception $e) {
            //throw $th;
           // return $e;
            return $this->errorData("Failed to Update Kitchenuser", 500);
        }
    }
    public function destroy($id)
    {
        try {
            $kitchenuser = Kitchenuser::find($id);
            if ($kitchenuser->delete()) {
                return $this->successResponse("Kitchenuser delete succesfully", 200);
            } else {
                return $this->errorData("Failed to delete Kitchenuser", 500);
            }
        } catch (\Exception $e) {
            //return $e;
            return $this->errorData("Failed to delete Kitchenuser", 500);
        }
    }
    public function removeall()
    {
        try {
            //code...
            $kitchenuser = Kitchenuser::truncate();
            return $this->successResponse("All Kitchenuser delete succesfully", 200);
        } catch (\Exception $e) {

            return $this->errorData("Failed to delete All Kitchenuser", 500);
        }
    }
}