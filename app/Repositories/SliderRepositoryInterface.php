<?php

namespace App\Repositories;

use App\Http\Request\Admin\SettingRequest;
use App\Http\Request\Admin\SliderRequest;
use Illuminate\Http\Request;

interface SliderRepositoryInterface
{
    public function store(string $locale, SliderRequest $request);
    public function update(string $lang, int $id, SliderRequest $request);
    public function delete(int $id);

}
