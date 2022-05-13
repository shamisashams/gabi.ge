<?php

namespace App\BogPay;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;



class BogPaymentController extends Controller
{
    //
    private $bog_pay;

    private $client_id = '14623';

    private $secret_key = '4f6b3517ceb23b6be16fd1b0fceb5e0a';



    public function __construct(){
        $this->bog_pay = new BogPay($this->client_id, $this->secret_key);



        //dd($this->rate);
    }


    public function make_order($order_id,$total){

        $response = $this->bog_pay->make_order(
            0,
            route('bogResponse').'?order_id='.$order_id,
            [['currency_code' => 'GEL', 'value' => $total]],
            0,
            [],
            1,
            $order_id,
            false
        );
        $data = $response->getContents();

        //dd($data);

        $data = json_decode($data,true);

        Order::where('id', '=', $order_id)->update(['transaction_id' => $data['order_id'],'bog_payment_hash'=> $data['payment_hash']]);
        //dd($data);
        return redirect($data['links'][1]['href']);
    }

    public function getAmount() {
//        $transactionId = Session::get('TBCSessionID');
        $userInformation = session('user_information') ?? null;
        $cart = session('products') ?? null;

        if ($cart !== null && $userInformation !== null) {
            $total = 0;
            foreach ($cart as $item) {
                $product = Product::find(intval($item->product_id));
                if ($product && $item->quantity > 0) {
                    $total += $item->quantity * $product->price;
                }
            }
            $order = Order::create([
                'transaction_id' => uniqid(),
                'total_price' => $total,
                'status' => 3,
                'first_name' => $userInformation['name'],
                'last_name' => $userInformation['surname'],
                'email' => $userInformation['email'],
                'phone' => $userInformation['phone'],
                'address' => $userInformation['address'],
                'details' => $userInformation['delivery_details'],
                'pay_type' => 1
            ]);

            $products = array();
            foreach ($cart as $item) {
                $product = Product::find(intval($item->product_id));
                if ($product && $item->quantity > 0) {
                    $products[] = (array)[
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'amount' => $product->price,
                        'total_price' => $product->price,
                        'quantity' => intval($item->quantity),
                    ];
                }
            }
            Session::put('transactionID', $order->transaction_id);
            $order->products()->createMany($products);

            return $this->make_order($order->id, $total * $this->rate / 10000);
        }
    }
}
