<?php

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\AdminUserRequest;
use App\Http\Request\Admin\OrderRequest;
use App\Http\Request\Admin\SliderRequest;
use App\Http\Request\PasswordChangeRequest;
use App\Http\Request\UserRequest;
use App\Models\Answer;
use App\Models\Faq;
use App\Models\FaqLanguage;
use App\Models\Help;
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
use App\Repositories\OrderRepositoryInsterface;
use App\Repositories\UserAdminRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class FaqRepository extends BaseRepository
{

    public function __construct(Faq $model)
    {
        parent::__construct($model);
    }


    public function store( $lang, $request)
    {


        //// Create new item

        try {
            DB::beginTransaction();

            $help = $this->model->create([]);

            /// Save with correct language
            $languageId = Language::getIdByName($lang);

            FaqLanguage::create([
                'faq_id' => $help->id,
                'language_id' => $languageId,
                'question' => $request['question'],
                'answer' => $request['answer'],
            ]);



            DB::commit();
            return true;
        } catch (\Exception $queryException) {
            DB::rollBack();
            return false;
        }
    }

    public function update(string $lang, int $id, $request)
    {


        try {
            DB::beginTransaction();

            $help = $this->find($id);


            /*$help->update([
                'type' => $request['type'],
            ]);*/

            $categoryId = $help->id;

            $languageId = Language::getIdByName($lang);

            $language = $help->language()->where('language_id', $languageId)->first();

            if (!$language) {
                FaqLanguage::create([
                    'faq_id' => $categoryId,
                    'language_id' => $languageId,
                    'question' => $request['question'],
                    'answer' => $request['answer'],
                ]);
            } else {
                $language->update([
                    'question' => $request['question'],
                    'answer' => $request['answer'],

                ]);
            }


            DB::commit();
            return true;
        } catch (\Exception $queryException) {
            DB::rollBack();
            return false;
        }
    }

}
