<?php

namespace App\Repositories\Frontend;

use Illuminate\Http\Request;

interface SliderRepositoryInterface
{
    public function getSliders();

    public function getBanner();
}
