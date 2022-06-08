<?php

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\AdminUserRequest;
use App\Http\Request\Admin\OrderRequest;
use App\Http\Request\Admin\SliderRequest;
use App\Http\Request\PasswordChangeRequest;
use App\Http\Request\UserRequest;
use App\Models\Answer;
use App\Models\Help;
use App\Models\HelpLanguage;
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

class HelpRepository extends BaseRepository
{

    public function __construct(Help $model)
    {
        parent::__construct($model);
    }


    public function store( $lang, $request)
    {

        $request['type'] = isset($request['type']) ? 1 : 0;

        //// Create new item

        try {
            DB::beginTransaction();

            $help = $this->model->create([
                'type' => $request['type'],
            ]);

            /// Save with correct language
            $languageId = Language::getIdByName($lang);

            HelpLanguage::create([
                'help_id' => $help->id,
                'language_id' => $languageId,
                'title' => $request['title'],
                'text' => $request['text'],
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
        $request['type'] = isset($request['type']) ? 1 : 0;

        try {
            DB::beginTransaction();

            $help = $this->find($id);


            $help->update([
                'type' => $request['type'],
            ]);

            $categoryId = $help->id;

            $languageId = Language::getIdByName($lang);

            $language = $help->language()->where('language_id', $languageId)->first();

            if (!$language) {
                HelpLanguage::create([
                    'help_id' => $categoryId,
                    'language_id' => $languageId,
                    'title' => $request['title'],
                    'text' => $request['text'],
                ]);
            } else {
                $language->update([
                    'title' => $request['title'],
                    'text' => $request['text'],

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
