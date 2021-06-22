<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Feature;
use App\Models\Language;
use App\Models\Localization;
use App\Models\PaymentType;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index($locale)
    {
        $products = array();
        $cart = session('products') ?? array();

        $total = 0;
        $localization = Language::where('abbreviation', app()->getLocale())->first()->id ?? 1;
        if ($cart !== null) {
            foreach ($cart as $item) {
                $product = Product::where(['id' => $item->product_id])->first();
                if ($product) {
                    $arr = array_values($item->options);
                    $answers = Answer::whereIn('id', $arr)->with('availableLanguage')->get();
                    $products[] = [
                        'id' => $product->id,
                        'category_id' => $product->category_id,
                        'price' => $product->price / 100,
                        'sale' => $product->saleProduct && $product->saleProduct->sale ?
                            Product::calculatePrice($product->price, $product->saleProduct->sale->discount, $product->saleProduct->sale->type) : '',
                        'title' => $product->language()->where('language_id', $localization)->first()->title ?? '',
                        'description' => $product->language()->where('language_id', $localization)->first()->description ?? '',
                        'file' => $product->files[0]->name ?? '',
                        'quantity' => intval($item->quantity),
                        'options' => $answers,
                        'features' => json_encode($item->options)
                    ];
                }
            }
            foreach ($cart as $item) {

                $total += intval($item->quantity) * intval($item->price) / 100;
            }

        }
        return view('pages.cart.index', compact('products', 'total'));
    }

    public function addToCart(Request $request, $locale, $id)
    {
        $products = session('products') ?? array();

        $options = (array)json_decode($request['options']);

        $bool = true;
        $answerIdArray = [];
        $featureIdArray = [];

        foreach ($products as $item) {
            if ($item->product_id == $id) {
                if ($options === $item->options) {
                    $bool = false;
                    break;
                }
            }
        }

        foreach ($options as $key => $option) {
            $featureIdArray[] = $key;
            $answerIdArray[] = $option;
        }

        $answerCount = Answer::whereIn('id', array_unique($answerIdArray))->count();
        $featureCount = Feature::whereIn('id', $featureIdArray)->count();

        if ($answerCount == count(array_unique($answerIdArray)) && $featureCount == count($featureIdArray)) {
            $product = Product::findOrFail(intval($id));
            if ($bool) {
                $products[] = (object)[
                    'product_id' => $product->id,
                    'quantity' => $request['quantity'],
                    'sale' => ($product->saleProduct && $product->saleProduct->sale) ? Product::calculatePrice($product->price, $product->saleProduct->sale->discount, $product->saleProduct->sale->type) : $product->price,
                    'price' => $product->price,
                    'options' => $options
                ];
                $request->session()->put('products', $products);
                return response()->json(array('status' => true));
            }
        }
        return response()->json(array('status' => false));

    }

    public function getCartCount()
    {
        $products = array();
        $cart = session('products') ?? array();

        $total = 0;
        $localization = Language::where('abbreviation', app()->getLocale())->first()->id ?? 1;
        if ($cart !== null) {
            foreach ($cart as $item) {
                $product = Product::where(['id' => $item->product_id])->first();
                if ($product) {
                    $products[] = [
                        'id' => $product->id,
                        'category_id' => $product->category_id,
                        'price' => $product->price / 100,
                        'sale' => $product->saleProduct && $product->saleProduct->sale ?
                            Product::calculatePrice($product->price, $product->saleProduct->sale->discount, $product->saleProduct->sale->type) : '',
                        'title' => $product->language()->where('language_id', $localization)->first()->title ?? '',
                        'description' => $product->language()->where('language_id', $localization)->first()->description ?? '',
                        'file' => $product->files[0]->name ?? '',
                        'quantity' => $item->quantity,
                        'options' => json_encode($item->options)
                    ];
                }
            }
//            $products = Product::whereIn('id', array_map('intval', $products))->get()->map(function ($prod) use ($localization, $total, $cart) {
//                $item = [
//                    'id' => $prod->id,
//                    'price' => $prod->price,
//                    'sale' => ($prod->saleProduct && $prod->saleProduct->sale) ?
//                        Product::calculatePrice($prod->price, $prod->saleProduct->sale->discount, $prod->saleProduct->sale->type) : '',
//                    'title' => $prod->language()->where('language_id', $localization)->first()->title ?? '',
//                    'description' => $prod->language()->where('language_id', $localization)->first()->description ?? '',
//                    'file' => $prod->files[0]->name ?? ''
//                ];
//                foreach ($cart as $key => $value) {
//                    if ($prod->id == $value->product_id) {
//                        $item['quantity'] = $value->quantity;
//                    }
//                }
//
//                return $item;
//            });
            foreach ($cart as $item) {

                $total += intval($item->quantity) * intval($item->price) / 100;
            }

        }
        return response()->json(array('status' => true, 'count' => count($cart), 'products' => $products, 'total' => $total));
    }

    public function addCartCount(Request $request, $locale, $id, $type)
    {
        $options = (array)json_decode($request['options']);
        $cart = session('products') ?? array();
        if ($cart !== null) {
            foreach ($cart as $key => $item) {
                if ($item->product_id == intval($id) && $item->options === $options) {
                    ($type == 1) ? $cart[$key]->quantity++ : $cart[$key]->quantity--;
                }
                if ($item->quantity <= 0) {
                    unset($cart[$key]);
                }
            }
            session(['products' => $cart]);
            return response()->json(array('status' => true));
        }
        return response()->json(array('status' => false));
    }

    public function removeFromCart($locale, Request $request)
    {

        $id = $request['id'];
        $options = (array)json_decode($request['features']);


        $cart = session('products') ?? array();
        if ($cart !== null) {
            foreach ($cart as $key => $item) {
                if ($item->product_id == $id && $item->options === $options) {
                    unset($cart[$key]);
                }
            }
            session(['products' => $cart]);
            return response()->json(array('status' => true,));
        }
        return response()->json(array('status' => false));
    }

    public function productBuy(string $locale, Product $product, Request $request)
    {
        $products = session('products') ?? array();
        $bool = true;
        foreach ($products as $item) {
            if ($item->product_id == $product->id) {
                $bool = false;
                break;
            }

        }

        if ($bool) {
            $products[] = (object)['product_id' => $product->id, 'quantity' => 1, 'price' => ($product->sale == 1) ? $product->sale_price : $product->price];
            $request->session()->put('products', $products);

        }
        return redirect(route('Cart', $locale));
    }
}
