<?php

namespace App\Repositories\Frontend\Eloquent;

use App\Http\Request\PasswordChangeRequest;
use App\Http\Request\UserRequest;
use App\Models\Answer;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Slider;
use App\Models\User;
use App\Repositories\Frontend\Eloquent\Base\BaseRepository;

use App\Repositories\Frontend\SliderRepositoryInterface;
use App\Repositories\Frontend\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function update(UserRequest $request)
    {

        //dd($request->all());
        $user = $this->model::find(auth()->user()->id);

        $profile = $user->profile()->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone' => $request['phone'],
        ]);

        $user->addresses()->delete();

        foreach ($request->post('country') as $key => $item){
            $user->addresses()->create([
                'country' => $item,
                'city' => $request->post('city')[$key],
                'address_1' => $request->post('address')[$key],
            ]);
        }

        if ($profile) {
            return true;
        }
        return false;


    }

    public function changePassword(PasswordChangeRequest $request)
    {
        $user = $this->model::find(auth()->user()->id);

        $user->password = Hash::make($request['password']);

        if ($user->save()) {
            return true;
        }
        return false;
    }

    public function userOrders()
    {
        return Order::where(['user_id' => auth()->user()->id])->with('products')->orderBy('created_at', 'desc')->paginate(12);

    }

    public function userOrder(int $id)
    {
        return Order::where(['user_id' => auth()->user()->id, 'id' => $id])->first();

    }

    public function orderProducts(int $id)
    {
        $orderProducts = OrderProduct::where(['order_id' => $id])
            ->join('orders', 'orders.id', '=', 'order_products.order_id')
            ->where('orders.user_id', '=', auth()->user()->id)
            ->with(['product.availableLanguage', 'product.saleProduct.sale'])
            ->get();

        foreach ($orderProducts as $orderProduct) {
            $arr = array_values((array)json_decode($orderProduct->options));
            $orderProduct['answers'] = Answer::whereIn('id', $arr)->with('availableLanguage')->get();
        }
        return $orderProducts;
    }

}
