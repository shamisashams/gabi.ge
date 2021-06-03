<?php

namespace App\Repositories;

use App\Http\Request\Admin\SettingRequest;
use Illuminate\Http\Request;

interface SettingRepositoryInterface
{
public function update(string $locale, SettingRequest $request, int $id);
}
