<?php

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\AdminUserRequest;
use App\Http\Request\Admin\SliderRequest;
use App\Http\Request\PasswordChangeRequest;
use App\Http\Request\UserRequest;
use App\Models\Answer;
use App\Models\Language;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Role;
use App\Models\Slider;
use App\Models\SliderLanguage;
use App\Models\User;
use App\Repositories\Frontend\Eloquent\Base\BaseRepository;

use App\Repositories\Frontend\SliderRepositoryInterface;
use App\Repositories\Frontend\UserRepositoryInterface;
use App\Repositories\UserAdminRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserAdminRepository extends BaseRepository implements UserAdminRepositoryInterface
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function store(string $locale, AdminUserRequest $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;

        $localizationID = Language::getIdByName($locale);

        try {
            DB::beginTransaction();
            $this->model = new User([
                'status' => $request['status'],
                'name' => $request['first_name']." ".$request['last_name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password'])
            ]);

            $this->model->save();
            $this->model->roles()->create($this->model->id, Role::where("slug", "user")->firstOrFail->id);

            $this->model->profile()->create([
                'user_id' => $this->model->id,
//                'language_id' => $localizationID,
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'city' => $request['city'],
                'country' => $request['country'],
            ]);

            $model = $this->model;

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $file) {
                    $imagename = date('Ymhs') . $file->getClientOriginalName();
                    $destination = base_path() . '/storage/app/public/slider/' . $this->model->id;
                    $request->file('images')[$key]->move($destination, $imagename);
                    $model->files()->create([
                        'name' => $imagename,
                        'path' => '/storage/app/public/slider/' . $model->id,
                        'format' => $file->getClientOriginalExtension(),
                    ]);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $dbException) {
            DB::rollBack();
            dd($dbException);
            return false;
        }
    }



    public function update(string $locale, int $id, AdminUserRequest $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;
        $data = $this->find($id);

        try {
            DB::beginTransaction();
            $toUpdateData = [
                'status' => $request['status'],
                'name' => $request['first_name']." ".$request['last_name'],
                'email' => $request['email'],
            ];
            if ($request['password']){
                $toUpdateData["password"]=Hash::make($request['password']);
            }
            $data->update($toUpdateData);

            $data->profile()->update([
//                'user_id' => $this->model->id,
//                'language_id' => $localizationID,
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'city' => $request['city'],
                'country' => $request['country'],
            ]);


            DB::commit();
            return true;
        } catch (\Exception $dbException) {
            DB::rollBack();
            return false;
        }
    }

    public function delete(int $id)
    {
        $data = $this->find($id);

        if ($data && $data->profile) {
            $data->profile()->delete();
        }
        if ($data && $data->roles) {
            $data->roles()->delete();
        }
        return $data ? $data->delete() : false;
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
