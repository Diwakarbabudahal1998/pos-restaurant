<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Appuser;
use Illuminate\Http\Request;

class AppuserController extends ApiBaseController
{
    //
    public function getSingle(Request $request)
    {
        //dd("hi diwakar");
        //return $request;
        return Appuser::find($request->id);
    }
    public function getAll()
    {
        //dd("hi diwakar");

        return Appuser::all();
    }
    public function store(Request $request)
    {
        try {
            //code...
            $appuser = new Appuser();
            $appuser->app_user_name = $request->app_user_name;
            $appuser->app_user_pin = $request->app_user_pin;
            if ($appuser->save()) {
                return $this->successResponse("Successfully Created AppUser", 200);
            } else {
                return $this->errorData("Failed to Created AppUser", 500);
            }
        } catch (\Exception $e) {
            //throw $th;
            return $this->errorData("Failed to Created AppUser", 500);
        }
    }
    public function update(Request $request)
    {
        try {
            //code...
            $appuser = Appuser::find($request->id);
            $appuser->app_user_name = $request->app_user_name;
            $appuser->app_user_pin = $request->app_user_pin;
            if ($appuser->save()) {
                return $this->successResponse("Successfully Update AppUser", 200);
            } else {
                return $this->errorData("Failed to Update AppUser", 500);
            }
        } catch (\Exception $e) {
            //throw $th;
            return $this->errorData("Failed to Update AppUser", 500);
        }
    }
    public function destroy($id)
    {
        try {
            $appuser = Appuser::find($id);
            if ($appuser->delete()) {
                return $this->successResponse("Appuser delete succesfully", 200);
            } else {
                return $this->errorData("Failed to delete Appuser", 500);
            }
        } catch (\Exception $e) {
            //return $e;
            return $this->errorData("Failed to delete Appuser", 500);
        }
    }
    public function removeall()
    {
        try {
            //code...
            $appuser = Appuser::truncate();
            return $this->successResponse("All Appuser delete succesfully", 200);
        } catch (\Exception $e) {

            return $this->errorData("Failed to delete All Appuser", 500);
        }
    }
}