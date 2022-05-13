<?php

namespace App\BogPay;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Http\Controllers\Controller;

class BogCallbackController extends Controller
{
    //

    public function status(Request $request){

        //dd($request->all());
        switch ($request->status){
            case 'success':
                Order::where('id','=',$request->shop_order_id)->update(['status' => 1]);
                break;
            case 'error':
                Order::where('id','=',$request->shop_order_id)->update(['status' => 2]);
                break;
            case 'in_progress':
                Order::where('id','=',$request->shop_order_id)->update(['status' => 3]);
                break;
        }
        return response('',200);
    }

    public function refund(Request $request){
        return response('',200);
    }
}
