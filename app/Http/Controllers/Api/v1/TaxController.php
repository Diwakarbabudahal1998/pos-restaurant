<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends ApiBaseController
{
    public function getAll()
    {
        //dd("hi diwakar");

        return Tax::all();
    }
    public function getSingle(Request $request)
    {
        //dd("hi diwakar");
        //return $request;
        return Tax::find($request->id);
    }
    //
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tax_name' => 'required',
            'tax_percentage' => 'required',
        ]);
        try {
            //code...
            $tax = new Tax();
            $tax->tax_name = $request->tax_name;
            $tax->tax_percentage = $request->tax_percentage;
            if ($tax->save()) {
                return $this->successResponse('Successfully Created Tax', 200);
            } else {
                return $this->errorData('Failed to Create Tax', 500);
            }
        } catch (\Exception $e) {
            //throw $th;
            return $this->errorData('Failed to Create Tax', 500);
        }
    }
    public function update(Request $request)
    {
        $validateData = $request->validate([
            'tax_name' => 'required',
            'tax_percentage' => 'required',
        ]);
        try {
            //code...
            $tax = Tax::find($request->id);
            $tax->tax_name = $request->tax_name;
            $tax->tax_percentage = $request->tax_percentage;
            if ($tax->save()) {
                return $this->successResponse('Successfully Update Tax', 200);
            } else {
                return $this->errorData('Failed to Update Tax', 500);
            }
        } catch (\Exception $e) {
            //throw $th;
            return $this->errorData('Failed to Update Tax', 500);
        }
    }
    public function destroy($id)
    {
        try {
            $tax = Tax::find($id);
            if ($tax->delete()) {
                return $this->successResponse("Tax delete succesfully", 200);
            } else {
                return $this->errorData("Failed to delete Tax", 500);
            }
        } catch (\Exception $e) {
            //return $e;
            return $this->errorData("Failed to delete Tax", 500);
        }
    }
    public function removeall()
    {
        try {
            //code...
            $tax = Tax::truncate();
            return $this->successResponse("All Tax delete succesfully", 200);
        } catch (\Exception $e) {

            return $this->errorData("Failed to delete All Tax", 500);
        }
    }
}