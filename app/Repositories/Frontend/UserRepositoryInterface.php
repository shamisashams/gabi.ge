<?php


namespace App\Repositories\Frontend;

use App\Http\Request\UserRequest;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{

    public function update(UserRequest $request);

}
