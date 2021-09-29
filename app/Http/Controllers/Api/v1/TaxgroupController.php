<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Taxgroup;
use Illuminate\Http\Request;

class TaxgroupController extends ApiBaseController
{
    //
    public function getAll()
    {
        //dd("hi diwakar");

        return Taxgroup::all();
    }
    public function getSingle(Request $request)
    {
        //dd("hi diwakar");
        //return $request;
        return Taxgroup::find($request->id);
    }
    //
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tax_group_name' => 'required',

        ]);
        try {
            //code...
            //dd("hi diwakar");
            $taxgroup = new Taxgroup();
            $taxgroup->tax_group_name = $request->tax_group_name;
            $taxgroup->tax_inclusive_product = $request->tax_inclusive_product;
            //return $taxgroup;
            if ($taxgroup->save()) {
                return $this->successResponse('Successfully Created taxgroup', 200);
            } else {
                return $this->errorData('Failed to Create taxgroup', 500);
            }
        } catch (\Exception $e) {
            //throw $th;
            //return $e;
            return $this->errorData('Failed to Create taxgroup', 500);
        }
    }
    public function update(Request $request)
    {
        $validateData = $request->validate([
            'tax_group_name' => 'required',

        ]);
        try {
            //code...
            //dd("hi diwakar");
            $taxgroup = Taxgroup::find($request->id);
            $taxgroup->tax_group_name = $request->tax_group_name;
            $taxgroup->tax_inclusive_product = $request->tax_inclusive_product;
           // return $taxgroup;
            if ($taxgroup->save()) {
                return $this->successResponse('Successfully Update taxgroup', 200);
            } else {
                return $this->errorData('Failed to Update taxgroup', 500);
            }
        } catch (\Exception $e) {
            //throw $th;
            return $e;
            return $this->errorData('Failed to Update taxgroup', 500);
        }
    }
    public function destroy($id)
    {
        try {
            $taxgroup = Taxgroup::find($id);
            if ($taxgroup->delete()) {
                return $this->successResponse("Taxgroup delete succesfully", 200);
            } else {
                return $this->errorData("Failed to delete Taxgroup", 500);
            }
        } catch (\Exception $e) {
            //return $e;
            return $this->errorData("Failed to delete Taxgroup", 500);
        }
    }
    public function removeall()
    {
        try {
            //code...
            $taxgroup = Taxgroup::truncate();
            return $this->successResponse("All Taxgroup delete succesfully", 200);
        } catch (\Exception $e) {

            return $this->errorData("Failed to delete All Taxgroup", 500);
        }
    }
}