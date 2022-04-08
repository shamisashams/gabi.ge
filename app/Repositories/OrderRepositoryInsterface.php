<?php


namespace App\Repositories;

use App\Http\Request\Admin\AdminUserRequest;
use App\Http\Request\Admin\OrderRequest;
use App\Http\Request\PasswordChangeRequest;
use App\Http\Request\UserRequest;
use Illuminate\Http\Request;

interface OrderRepositoryInsterface
{

    public function update(string $lang, int $id,OrderRequest $request);
    public function store(string $lang, OrderRequest $request);
    public function findData(int $id,  array $relation = [], $columns = ['*']);




}
