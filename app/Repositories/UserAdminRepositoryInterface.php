<?php


namespace App\Repositories;

use App\Http\Request\Admin\AdminUserRequest;
use App\Http\Request\PasswordChangeRequest;
use App\Http\Request\UserRequest;
use Illuminate\Http\Request;

interface UserAdminRepositoryInterface
{

    public function update(string $lang, int $id,AdminUserRequest $request);
    public function store(string $lang, AdminUserRequest $request);

    public function changePassword(PasswordChangeRequest $request);

    public function userOrders();

    public function userOrder(int $id);

    public function orderProducts(int $id);




}
