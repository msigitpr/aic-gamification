<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Throwable;
use ilim;
use App\Models\Customer;
use App\Models\Voucher;
use Carbon\Carbon;

class GamificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function eligibility(Request $request) {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $customer_id = $request->input('id');
        $response = [
            'status' => false,
            'message' => 'You are not eligible to participate in this campaign'
        ];

        // Check if customer_id is eligible to participate
        try {
            $customer = Customer::find($customer_id);
            $response['total_transaction'] = count($customer->purchaseInMonth);
            $response['total_spent'] = $customer->sumPurchaseInMonth();

            if ($response['total_transaction'] < 3) {
                return $response;
            }
            if ($response['total_spent'] <= 100) {
                return $response;
            }
            if ($response['total_spent'] <= 100) {
                return $response;
            }
            if (Voucher::where('customer_id', $customer_id)->first()) {
                $response['message'] = "You already have locked voucher";
                return $response;
            }

            // Lock the voucher
            $voucher = Voucher::where([['customer_id', null], ['locked_at', null], ['expired_at', null]])->first();
            $voucher->customer_id = $customer_id;
            $voucher->locked_at = Carbon::now()->toDateTimeString();
            $voucher->expired_at = Carbon::now()->addMinute(10)->toDateTimeString();
            $voucher->save();

            $response['status'] = true;
            $response['message'] = "The voucher has been locked for you, please take a selfie with the product in 10 minutes to get the voucher code";
            return $response;
        } catch (Throwable  $e) {   
            $response['message'] = "Customer not found";
            return $response;
        }
    }

    public function submission(Request $request) {
        $this->validate($request, [
            'id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $response = [
            'status' => false,
            'message' => "Submission not valid"
        ];
        
        // Find the voucher belongs to customer_id, if found  then update "redeemed" field
        $customer_id = $request->input('id');
        try {
            $voucher = Voucher::where('customer_id', $customer_id)->first();
            $response['status'] = true;
            if ($voucher->redeemed) {
                $response['message'] = "You already submit the photo";
                $response['voucher_code'] = $voucher->code;
                return $response;
            }
            $voucher->redeemed = 1;
            $voucher->save();
        
            $response['message'] = "Congratulations! you are now allowed to use the voucher code ";
            $response['voucher_code'] = $voucher->code;
            return $response;

        } catch (\Throwable $th) {
            return $response;
        }
    }
}
