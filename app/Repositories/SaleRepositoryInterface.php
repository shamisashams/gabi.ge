<?php

namespace App\Repositories;

use App\Http\Request\Admin\PageRequest;
use App\Http\Request\Admin\SaleRequest;
use Illuminate\Http\Request;

interface SaleRepositoryInterface
{

    public function store(string $locale,SaleRequest $request);

    public function update(string $locale, int $id, SaleRequest $request);

    public function delete(int $id);


}
