<?php

namespace App\Http\Controllers;

use App\Http\Request\Admin\AnswerRequest;
use App\Http\Request\PasswordChangeRequest;
use App\Http\Request\UserRequest;
use App\Models\Answer;
use App\Models\City;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Language;
use App\Models\Localization;
use App\Models\User;
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\Frontend\CategoryRepositoryInterface;
use App\Repositories\Frontend\ProductRepositoryInterface;
use App\Repositories\Frontend\SliderRepositoryInterface;
use App\Repositories\Frontend\UserRepositoryInterface;
use App\Services\AnswerService;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    protected $userRepository;


    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function index($locale)
    {
        $cities = City::with('language')->get();

        $result = [];
        foreach ($cities as $city){
            $result[$city->country_id][] = $city;
        }
        return view('pages.user.profile', [
            'user' => auth()->user(),
            'countries' => Country::with(['language','cities','cities.language'])->get(),
            'cities' => $result,
            'orders' => $this->userRepository->userOrders()
        ]);
    }

    public function update(string $locale, UserRequest $request)
    {
        //dd($request->all());
        if (!$this->userRepository->update($request)) {
            return redirect(route('profile', $locale))->with('danger', __('client.your_information_not_updated'));
        }

        return redirect(route('profile', $locale))->with('success', __('admin.your_information_updated'));
    }

    public function changePassword(string $locale, PasswordChangeRequest $request)
    {

        if (!$this->userRepository->changePassword($request)) {
            return redirect(route('profile', $locale))->with('danger', __('client.password_not_updated'));
        }

        return redirect(route('profile', $locale))->with('success', __('admin.password_updated'));
    }

    public function orderDetails(string $locale, int $id)
    {
        return view('pages.user.order-details', [
            'orderProducts' => $this->userRepository->orderProducts($id),
            'order' => $this->userRepository->userOrder($id)
        ]);
    }

    public function downloadPdf(string $locale, $id)
    {
        $orderProducts = $this->userRepository->orderProducts(intval($id));
        if (count($orderProducts) > 0) {
            view()->share('orderProducts', $orderProducts);
            $pdf = PDF::loadView('/pages/pdf/order-products', $orderProducts);
            return $pdf->download('Order Products.pdf');
        }

    }

    public function updateAvatar(Request $request){
       if($request->has('avatar')){
           $user = User::query()->find(auth()->id());
           Storage::delete($user->google_avatar);
           $path = $request->file('avatar')->store('public/avatars');

           $user
           ->update(['google_avatar' => $path]);
       }
    }

    public function addAddress(){
        return view('pages.user.address');
    }


}
