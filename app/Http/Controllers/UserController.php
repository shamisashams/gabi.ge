<?php

namespace App\Http\Controllers;

use App\Http\Request\Admin\AnswerRequest;
use App\Http\Request\PasswordChangeRequest;
use App\Http\Request\UserRequest;
use App\Models\Answer;
use App\Models\Feature;
use App\Models\Language;
use App\Models\Localization;
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\Frontend\CategoryRepositoryInterface;
use App\Repositories\Frontend\ProductRepositoryInterface;
use App\Repositories\Frontend\SliderRepositoryInterface;
use App\Repositories\Frontend\UserRepositoryInterface;
use App\Services\AnswerService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Lang;

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

        return view('pages.user.profile', [
            'user' => auth()->user()
        ]);
    }

    public function update(string $locale, UserRequest $request)
    {
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
}
