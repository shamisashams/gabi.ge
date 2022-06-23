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
use App\Models\ShippingTranslation;
use App\Models\User;
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class ShippingRepository extends BaseRepository
{

    public function __construct(Shipping $model)
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


        try {
            DB::beginTransaction();

            $newItem = $this->model->create([
                'price' => $request['price'],
            ]);

            /// Save with correct language
            $languageId = Language::getIdByName($lang);

            ShippingTranslation::create([
                'shipping_id' => $newItem->id,
                'language_id' => $languageId,
                'title' => $request['title'],
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

        try {
            DB::beginTransaction();

            $productItem = $this->find($id);

            $productItem->update([
                'price' => $request['price'],
            ]);

            $languageId = Language::getIdByName($lang);
            $language = $productItem->language()->where('language_id', $languageId)->first();
            if ($language) {
                $language->update([
                    'language_id' => $languageId,
                    'title' => $request['title'],
                ]);
            } else {
                ShippingTranslation::create([
                    'shipping_id' => $productItem->id,
                    'language_id' => $languageId,
                    'title' => $request['title'],
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
