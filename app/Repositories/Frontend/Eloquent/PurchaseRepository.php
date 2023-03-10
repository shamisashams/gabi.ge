<?php

namespace App\Repositories\Frontend\Eloquent;

use App\Http\Request\RegisterRequest;
use App\Models\Bank;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\Shipping;
use App\Repositories\Frontend\Eloquent\Base\BaseRepository;
use App\Repositories\Frontend\PurchaseRepositoryInterface;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseRepository extends BaseRepository implements PurchaseRepositoryInterface
{

    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function saveOrder(Request $request)
    {
        $cart = session('products') ?? null;

        if ($cart !== null && count($cart) > 0) {
            $total = 0;
            $shipmentPrice = 0;
            // validate and get total
            foreach ($cart as $item) {
                $product = Product::find(intval($item->product_id));
                if ($product && $item->quantity > 0) {
                    $total += $item->quantity * (($product->saleProduct && $product->saleProduct->sale) ?
                            Product::calculatePrice($product->price, $product->saleProduct->sale->discount, $product->saleProduct->sale->type) * 100
                            : $product->price);
                }
            }
            //$shipping = Shipping::query()->find($request['shipping']);
            $address = auth()->user()->addresses()->find($request->post('address'));

            $shipmentPrice = $address->city_r->ship_price;

            if ($request['shipping'] === 'from_office') {
                $shipmentPrice = 0;
            }


            $total += $shipmentPrice; // mitana

            $paymentType = PaymentType::where(['title' => $request['payment_method']])->first();

            //dd($address->country_r->language,$total);

            //$bank = $request->post('bank');
            //$paymentType = $request->post('payment_method');
            $bank = Bank::where(['id' => $request['bank'], 'payment_type_id' => $paymentType ? $paymentType->id : ""])->first();
//            if (!$bank) {
//                $bank = Bank::where(['title' => $request['installment_bank'], 'payment_type_id' => $paymentType->id])->first();
//            }
            try {
                DB::beginTransaction();
                $order = Order::create([
                    'bank_id' => $bank ? $bank->id : null,
                    'user_id' => auth()->user()->id,
                    'payment_type_id' => $paymentType ? $paymentType->id : null,
                    'transaction_id' => uniqid(),
                    'shipment_price' => $shipmentPrice,
                    'total_price' => $total,
                    'status' => 3,
                    'first_name' => auth()->user()->profile->first_name,
                    'last_name' => auth()->user()->profile->last_name,
                    'email' => auth()->user()->email,
                    'phone' => auth()->user()->profile->phone,
                    'address' => $address->address_1,
                    'city' => $address->city_r->language ? $address->city_r->language->title : '',
                    'country' =>  $address->city_r->language ? $address->country_r->language->title : '',
                ]);

                $products = array();
                foreach ($cart as $item) {
                    $product = Product::find(intval($item->product_id));
                    if ($product && $item->quantity > 0) {

                        $products[] = [
                            'order_id' => $order->id,
                            'product_id' => $product->id,
                            'amount' => $product->price,
                            'total_price' => ($product->saleProduct && $product->saleProduct->sale) ?
                                Product::calculatePrice($product->price, $product->saleProduct->sale->discount, $product->saleProduct->sale->type) * 100
                                : $product->price,
                            'options' => json_encode($item->options),
                            'quantity' => intval($item->quantity),
                        ];
                    }
                }
                $order->products()->createMany($products);
                DB::commit();
                return $order;
            } catch (QueryException $exception) {
                DB::rollBack();
                return false;
            }
        }
        return false;
    }
}
