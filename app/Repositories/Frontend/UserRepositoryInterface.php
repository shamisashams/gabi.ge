<?php


namespace App\Repositories\Frontend;

use App\Http\Request\PasswordChangeRequest;
use App\Http\Request\UserRequest;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{

    public function update(UserRequest $request);

    public function changePassword(PasswordChangeRequest $request);

    public function userOrders();

    public function userOrder(int $id);

    public function orderProducts(int $id);




}
