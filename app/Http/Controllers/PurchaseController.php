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

class PurchaseController extends Controller
{
    protected $purchaseRepository;


    public function __construct(PurchaseRepositoryInterface $purchaseRepository)
    {
        $this->purchaseRepository = $purchaseRepository;

    }


    public function saveOrder(string $locale, Request $request)
    {
        $request->validate([
            'shipping' => 'required|string|max:255',
            'address' => 'required|string|max:255'
        ]);
        if ($this->purchaseRepository->saveOrder($request)) {
            session(['products' => []]);
            return redirect($locale . '/profile?type=order')->with('success', __('client.order_saved'));
        }
        return redirect(route('profile', $locale))->with('success', __('client.order_not_saved'));
    }



}
