<?php

namespace App\Repositories\Frontend;

use Illuminate\Http\Request;

interface PurchaseRepositoryInterface
{

    public function saveOrder(Request $request);

}
