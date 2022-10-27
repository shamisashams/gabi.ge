<?php

/**
 *  app/Repositories/Eloquent/UserRepository.php
 *
 * Date-Time: 19.05.21
 * Time: 10:54
 * @author Insite International <hello@insite.international>
 */

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\AnswerRequest;
use App\Models\Answer;
use App\Models\Feature;
use App\Models\Language;
use App\Models\Shipping;
use App\Models\SizeGuide;
use App\Models\ShippingTranslation;
use App\Models\SizeguideLanguage;
use App\Models\User;
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class SizeguideRepository extends BaseRepository
{

    public function __construct(SizeGuide $model)
    {
        parent::__construct($model);
    }


    /**
     * Create Answer item into db.
     *
     * @param string $lang
     * @param array $request
     * @return bool
     */

    public function store(string $lang, $request)
    {

        //$request['status'] = isset($request['status']) ? 1 : 0;
        // Create new item
        // dd($request->all());
        $savedata = $request->except(["_token", "age"]);

        if ($savedata['gender'] == "true") {
            $savedata['gender'] = 1;
        } else {
            $savedata['gender'] = 0;
        }
        // dd($savedata, $savedata['gender']);
        try {
            DB::beginTransaction();

            $newItem = $this->model->create($savedata);

            /// Save with correct language
            $languageId = Language::getIdByName($lang);

            SizeguideLanguage::create([
                'sizeguides_id' => $newItem->id,
                'language_id' => $languageId,
                // 'title' => $request['title'],
                'age' => $request['age'],
            ]);

            DB::commit();
            return true;
        } catch (\Exception $queryException) {
            DB::rollBack();
            dd($queryException->getMessage());
            return false;
        }
    }

    /**
     * Update Answer item.
     *
     * @param int $id
     * @param AnswerRequest $request
     * @return bool
     */

    public function update(string $lang, int $id, $request)
    {
        //$request['status'] = isset($request['status']) ? 1 : 0;

        $savedata = $request->except(["_token", 'age']);
        if ($savedata['gender'] == "true") {
            $savedata['gender'] = 1;
        } else {
            $savedata['gender'] = 0;
        }
        // dd($savedata);
        try {
            DB::beginTransaction();

            // $productItem = $this->find($id);
            $productItem = SizeGuide::find($id);
            // dd($productItem->language());

            // $productItem->update([
            //     'price' => $request['price'],
            // ]);
            $updt = $productItem->update($savedata);
            $languageId = Language::getIdByName($lang);
            // dd($languageId->language());
            $language = $productItem->language()->where('language_id', $languageId)->first();
            if ($language) {
                $language->update([
                    'language_id' => $languageId,
                    'age' => $request['age'],
                ]);
            } else {
                SizeguideLanguage::create([
                    'sizeguides_id' => $productItem->id,
                    'language_id' => $languageId,
                    'age' => $request['age'],
                ]);
            }


            DB::commit();
            return true;
        } catch (\Exception $queryException) {
            DB::rollBack();
            dd($queryException->getMessage());
            return false;
        }
    }

    /**
     * Create localization item into db.
     *
     * @param string $lang
     * @return Language
     * @throws \Exception
     */
    protected function getLocalization(string $lang)
    {
        $localization = Language::where('abbreviation', $lang)->first();
        if (!$localization) {
            throwException('Localization not exist.');
        }

        return $localization;
    }

    public function delete(int $id)
    {
        $data = $this->find($id);

        return $data->delete();
    }
}
