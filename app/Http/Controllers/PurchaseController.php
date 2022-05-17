<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Product;
use App\Repositories\Frontend\PurchaseRepositoryInterface;
use App\Repositories\Frontend\UserRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Lang;
use App\BogPay\BogPaymentController;

class PurchaseController extends Controller
{
    protected $purchaseRepository;


    public function __construct(PurchaseRepositoryInterface $purchaseRepository)
    {
        $this->purchaseRepository = $purchaseRepository;

    }


    public function saveOrder(string $locale, Request $request)
    {

        //dd($request->all());
        $request->validate([
            'shipping' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'bank' => $request['payment_method'] == 'card' ? 'required|string|max:255' : 'string|max:255',
            'payment_method' => 'required|string|max:255'
        ]);
        if ($order = $this->purchaseRepository->saveOrder($request)) {
            //dd($order->paymentType->title);
            session(['products' => []]);
            if($order->paymentType->title == 'card' && $order->bank->title == 'bog'){
                return app(BogPaymentController::class)->make_order($order->id,round($order->total_price / 100,2));
            } else {
                return redirect($locale . '/profile?type=order')->with('success', __('client.order_saved'));
            }

        }
        return redirect(route('profile', $locale))->with('success', __('client.order_not_saved'));
    }

    public function bogResponse(Request $request){
        //dd($request->order_id);
        $order = Order::query()->where('id',$request->order_id)->first();

        if($order->status == 1) return redirect(route('orderSuccessView').'?transactionID='.$order->transaction_id);
        else if($order->status == 2) return redirect(route('orderFailView'));
        else return redirect(route('bogResponse'));
    }


}
