<?php

namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\AnswerRequest;
use App\Models\Answer;
use App\Models\Feature;
use App\Models\Language;
use App\Models\Localization;
use App\Repositories\AnswerRepositoryInterface;
use App\Services\AnswerService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Lang;

class AnswerController extends AdminController
{
    protected $answerRepository;

    public function __construct(AnswerRepositoryInterface $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function index($locale, Request $request)
    {
        $request->validate([
            'feature' => 'integer|nullable',
            'position' => 'string|max:255|nullable',
            'title' => 'string|max:255|nullable',
            'status' => 'integer|nullable',
        ]);

        return view('admin.modules.answer.index',
            [
                'answers' => $this->answerRepository->getData($request, ['availableLanguage', 'feature.feature.availableLanguage']),
                'features' => Feature::all(),
            ]);
    }

    public function show(string $locale, int $id)
    {
        return view('admin.modules.answer.view', [
            'answer' => $this->answerRepository->find($id)
        ]);
    }

    public function create($locale)
    {
        $features = Feature::all();
        return view('admin.modules.answer.create',
            [
                'features' => $features,
            ]);
    }

    public function edit($locale, $id)
    {
        $features = Feature::all();
        return view('admin.modules.answer.update',
            [
                'answer' => $this->answerRepository->find($id),
                'features' => $features,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerRequest $request, $locale)
    {
        if (!$this->answerRepository->store($locale, $request)) {
            return redirect(route('answerIndex', $locale))->with('danger', __('admin.answer_not_created'));
        }

        return redirect(route('answerIndex', $locale))->with('success', __('admin.answer_success_create'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Answer $answer
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(AnswerRequest $request, $locale, $id)
    {
        if (!$this->answerRepository->update($locale, $id, $request)) {
            return redirect(route('answerIndex', $locale))->with('danger', __('admin.answer_not_updated'));
        }

        return redirect(route('answerIndex', $locale))->with('success', __('admin.answer_success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $locale
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(string $locale, int $id)
    {
        if (!$this->answerRepository->delete($id)) {
            return redirect(route('answerIndex', $locale))->with('danger', __('admin.answer_not_deleted'));
        }
        return redirect(route('answerIndex', $locale))->with('success', __('admin.answer_success_delete'));
    }
}
