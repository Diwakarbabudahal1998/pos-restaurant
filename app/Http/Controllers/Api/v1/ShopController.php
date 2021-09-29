<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ShopController extends ApiBaseController
{
    //
    public function update(Request $request)
    {
        try {
            $shop = Shop::first();
            if(!isset($shop)){
                $shop = new Shop();
            }
            else{
                if($request->hasFile('image')){
                    Storage::delete('public/shop/' .$shop->id.'/'.$shop->image);
                }
            }
            $shop->shop_name = $request->shop_name;
            $shop->business_type = $request->business_type;
            $shop->city = $request->city;
            $shop->shop_owner_pin = $request->shop_owner_pin;
            $shop->website_link = $request->website_link;
            $shop->facebook_link = $request->facebook_link;
            $shop->instagram_link = $request->instagram_link;

            if ($request->hasFile('image')) {
                $validatedData = $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg|max:5000',
                ]);
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();

                $shop->image = $filename;
            }
            if ($shop->save()) {
                if ($request->hasFile('image')) {
                    Storage::putFileAs('public/shop/' . $shop->id . '/', new File($image), $filename);
                }
                return $this->successResponse("Successfully updated Shop", 200);
            } else {
                return $this->errorData("Failed to update Shop", 500);
            }
        } catch (\Exception $e) {
            return $e;
            return $this->errorData("Failed to update Shop", 500);
        }
    }


    public function get(Request $request){

        try{
            $shop= Shop::first();
            if(isset($shop->image)){
                $shop->image = asset('storage/shop/'.$shop->id.'/'.$shop->image);
            }
            return $this->successData("success", $shop);
        }
        catch(\Exception $e){
            return $e;
        }
      

    }
}