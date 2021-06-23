<?php

namespace App\Repositories\Frontend\Eloquent;

use App\Http\Request\UserRequest;
use App\Models\Slider;
use App\Models\User;
use App\Repositories\Frontend\Eloquent\Base\BaseRepository;

use App\Repositories\Frontend\SliderRepositoryInterface;
use App\Repositories\Frontend\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function update(UserRequest $request)
    {
        $user = $this->model::find(auth()->user()->id);

        $profile = $user->profile()->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone' => $request['phone'],
            'city' => $request['city'],
            'country' => $request['country'],
            'address' => $request['address'],
        ]);

        if ($profile) {
            return true;
        }
        return false;

    }


}
