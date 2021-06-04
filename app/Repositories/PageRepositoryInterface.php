<?php

namespace App\Repositories;

use App\Http\Request\Admin\PageRequest;
use Illuminate\Http\Request;

interface PageRepositoryInterface
{
    public function update(string $locale, int $id, PageRequest $request);
}
