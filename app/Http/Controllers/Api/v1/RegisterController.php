<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Register;
use Illuminate\Http\Request;

class RegisterController extends ApiBaseController
{

    public function getAll(Request $request)
    {
        try {
            $order_key = "created_at";
            $order_direction = "desc";
            //return $request->orderBy;
            if (isset($request->orderBy)) {
                $orders = json_decode($request->orderBy);
                $order_key = $orders->field;
                $order_direction = $request->orderDirection;
            }
            $registers = Register::where(function ($query) use ($request) {
                $query->where("register_name", "LIKE", "%{$request->search}%");
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
            return $registers;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getSingle(Request $request)
    {

        return Register::find($request->register_id);
    }
    //
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'register_name' => 'required',
            'receipt_number_prefix' => 'required',
            'bill_header' => 'required',
            'bill_footer' => 'required',
            'printed_type' => 'required',

        ]);
        try {
            $register = new Register();
            $register->register_name = $request->register_name;
            $register->receipt_number_prefix = $request->receipt_number_prefix;
            $register->bill_header = $request->bill_header;
            $register->bill_footer = $request->bill_footer;
            $register->printed_type = $request->printed_type;
            $register->print_receipt_order = json_decode($request->print_receipt_order);
            $register->include_shop_logo = json_decode($request->include_shop_logo);
            $register->table_number = $request->table_number;
            $register->server_ip_address = $request->server_ip_address;
            $register->kds_state_time = $request->kds_state_time;
            $register->accept_status_order = json_decode($request->accept_status_order);
            $register->served_status_order = json_decode($request->served_status_order);
            $register->change_status_item = json_decode($request->change_status_item);
            // return $register;
            if ($register->save()) {
                return $this->successResponse("Successfully Completed Register", 200);
            } else {
                return $this->errorData("Failed to Create Register", 500);
            }
        } catch (\Exception $e) {
            return $e;
            return $this->errorData("Failed to Create Register", 500);
        }
    }
    public function update(Request $request)
    {
        $validateData = $request->validate([
            'register_name' => 'required',
            'receipt_number_prefix' => 'required',
            'bill_header' => 'required',
            'bill_footer' => 'required',
            'printed_type' => 'required',

        ]);
        try {

            $register = Register::find($request->id);
            $register->register_name = $request->register_name;
            $register->receipt_number_prefix = $request->receipt_number_prefix;
            $register->bill_header = $request->bill_header;
            $register->bill_footer = $request->bill_footer;
            $register->printed_type = $request->printed_type;
            $register->print_receipt_order = json_decode($request->print_receipt_order);
            $register->include_shop_logo = json_decode($request->include_shop_logo);
            $register->table_number = $request->table_number;
            $register->server_ip_address = $request->server_ip_address;
            $register->kds_state_time = $request->kds_state_time;
            $register->accept_status_order = json_decode($request->accept_status_order);
            $register->served_status_order = json_decode($request->served_status_order);
            $register->change_status_item = json_decode($request->change_status_item);

            if ($register->save()) {
                return $this->successResponse("Successfully Update Register", 200);
            } else {
                return $this->errorData("Failed to Update Register", 500);
            }
        } catch (\Exception $e) {
            //return $e;
            return $this->errorData("Failed to Update Register", 500);
        }
    }
    public function destroy($id)
    {
        try {
            $register = Register::find($id);
            if ($register->delete()) {
                return $this->successResponse("Register delete succesfully", 200);
            } else {
                return $this->errorData("Failed to delete Register", 500);
            }
        } catch (\Exception $e) {
            //return $e;
            return $this->errorData("Failed to delete Register", 500);
        }
    }

    public function deleteMass(Request $request)
    {
        try {
            $ids = json_decode($request->register_id);
            Register::whereIn('id', $ids)->delete();
            return $this->successResponse("Successfully deleted registers", 200);
        } catch (\Exception $e) {
            return $e;
            return $this->errorData("failed to delete", 500);
        }
    }
}