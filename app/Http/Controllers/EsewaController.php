<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use App\Order;
use App\OrderDetail;
use App\BusinessSetting;
use App\Seller;
use App\Checkout;
use Session;
use App\CustomerPackage;
use App\SellerPackage;
use App\Http\Controllers\CustomerPackageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\WalletController;

class EsewaController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function esewa()
    {
      $order_id = Session::get('order_id');
    
      $ordercode = Order::where('id', $order_id)->first();
      
   
      return view('frontend.payment.esewa',compact('ordercode'));
     
      
    }
  
    public function success(Request $request)
    {
     
  	    $oid = $_GET['oid'];
        $amt = $_GET['amt'];
        $refId=$_GET['refId'];
        $order = Order::where('code',$oid)->first();
    
        if($amt == $order->grand_total ){
            $order_details = OrderDetail::where('order_id',$order->id)->update(['payment_status'=>'paid']);
            $order->payment_status = 'paid';
            $json =json_encode([
                'refid id' =>$refId,
                'order id' =>$oid,
                'amt' =>$amt,
            ]);
            $order->payment_details =$json;
          
        	$order->save();
            $payment=$json;

           
            $order = Order::findOrFail($order->id);
            $order->payment_status = 'paid';
            $order->payment_details = $payment;
            $order->save();

            if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliatePoints($order);
            }

            if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
                $clubpointController = new ClubPointController;
                $clubpointController->processClubPoints($order);
            }

            if(\App\Addon::where('unique_identifier', 'seller_subscription')->first() == null || !\App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated){
                if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                    $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                    foreach ($order->orderDetails as $key => $orderDetail) {
                        $orderDetail->payment_status = 'paid';
                        $orderDetail->save();
                        if($orderDetail->product->user->user_type == 'seller'){
                            $seller = $orderDetail->product->user->seller;
                            $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100 + $orderDetail->tax + $orderDetail->shipping_cost;
                            $seller->save();
                        }
                    }
                }
                else{
                    foreach ($order->orderDetails as $key => $orderDetail) {
                        $orderDetail->payment_status = 'paid';
                        $orderDetail->save();
                        if($orderDetail->product->user->user_type == 'seller'){
                            $commission_percentage = $orderDetail->product->category->commision_rate;
                            $seller = $orderDetail->product->user->seller;
                            $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100  + $orderDetail->tax + $orderDetail->shipping_cost;
                            $seller->save();
                        }
                    }
                }
            }
            else {
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $orderDetail->payment_status = 'paid';
                    $orderDetail->save();
                    if($orderDetail->product->user->user_type == 'seller'){
                        $seller = $orderDetail->product->user->seller;
                        $seller->admin_to_pay = $seller->admin_to_pay + $orderDetail->price + $orderDetail->tax + $orderDetail->shipping_cost;
                        $seller->save();
                    }
                }
            }

            $order->commission_calculated = 1;
            $order->save();

            Session::put('cart', collect([]));
            // Session::forget('order_id');
            Session::forget('payment_type');
            Session::forget('delivery_info');
            Session::forget('coupon_id');
            Session::forget('coupon_discount');

            flash(__('Payment completed'))->success();
    
            return redirect()->route('order_confirmed');

        }
      
    }
  
    public function fail()
    {
   
        abort(404);
       
    }


}