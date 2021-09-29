<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Waiteruser;
use Illuminate\Http\Request;

class WaiteruserController extends ApiBaseController
{
    //
    public function getSingle(Request $request)
    {
        //dd("hi diwakar");
        //return $request;
        return Waiteruser::find($request->id);
    }
    public function getAll()
    {
        //dd("hi diwakar");

        return Waiteruser::all();
    }
    public function store(Request $request)
    {
        try {
            //code...
            $waiteruser = new Waiteruser();
            $waiteruser->waiter_name = $request->waiter_name;
            $waiteruser->waiter_pin = $request->waiter_pin;
            if ($waiteruser->save()) {
                return $this->successResponse("Successfully Created Waiteruser", 200);
            } else {
                return $this->errorData("Failed to Created Waiteruser", 500);
            }
        } catch (\Exception $e) {
            //throw $th;
            return $this->errorData("Failed to Created Waiteruser", 500);
        }
    }
    public function update(Request $request)
    {
        try {
            //code...
            $waiteruser = Waiteruser::find($request->id);
            $waiteruser->waiter_name = $request->waiter_name;
            $waiteruser->waiter_pin = $request->waiter_pin;
            if ($waiteruser->save()) {
                return $this->successResponse("Successfully Update Waiteruser", 200);
            } else {
                return $this->errorData("Failed to Update Waiteruser", 500);
            }
        } catch (\Exception $e) {
            //throw $th;
            return $this->errorData("Failed to Update Waiteruser", 500);
        }
    }
    public function destroy($id)
    {
        try {
            $waiteruser = Waiteruser::find($id);
            if ($waiteruser->delete()) {
                return $this->successResponse("Waiteruser delete succesfully", 200);
            } else {
                return $this->errorData("Failed to delete Waiteruser", 500);
            }
        } catch (\Exception $e) {
            //return $e;
            return $this->errorData("Failed to delete Waiteruser", 500);
        }
    }
    public function removeall()
    {
        try {
            //code...
            $waiteruser = Waiteruser::truncate();
            return $this->successResponse("All Waiteruser delete succesfully", 200);
        } catch (\Exception $e) {

            return $this->errorData("Failed to delete All Waiteruser", 500);
        }
    }
}