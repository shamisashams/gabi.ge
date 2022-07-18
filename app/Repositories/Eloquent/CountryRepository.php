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
use App\Models\City;
use App\Models\CityTranslation;
use App\Models\Country;
use App\Models\CountryTranslation;
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
class CountryRepository extends BaseRepository
{

    private $cityRepository;

    public function __construct(Country $model, CityRepository $cityRepository)
    {
        parent::__construct($model);
        $this->cityRepository = $cityRepository;
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

        //dd($request->all());

        try {
            DB::beginTransaction();

            $newItem = $this->model->create([
                'code' => $request['code'],
            ]);

            /// Save with correct language
            $languageId = Language::getIdByName($lang);

            CountryTranslation::create([
                'country_id' => $newItem->id,
                'language_id' => $languageId,
                'title' => $request['title'],
            ]);

            if ($request->has('city_title')){
                foreach ($request->post('city_title') as $key => $item){
                    $city = City::create([
                        'country_id' => $newItem->id,
                        'ship_price' => $request['city_price'][$key],
                        'code' => '',
                    ]);

                    CityTranslation::create([
                        'city_id' => $city->id,
                        'language_id' => $languageId,
                        'title' => $item,
                    ]);
                }
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
     * Update Answer item.
     *
     * @param int $id
     * @param AnswerRequest $request
     * @return bool
     */

    public function update(string $lang, int $id, $request)
    {
        //$request['status'] = isset($request['status']) ? 1 : 0;

        //dd($request->all());
        try {
            DB::beginTransaction();

            $productItem = $this->find($id);

            $productItem->update([
                'code' => $request['code'],
            ]);

            $languageId = Language::getIdByName($lang);
            $language = $productItem->language()->where('language_id', $languageId)->first();
            if ($language) {
                $language->update([
                    'language_id' => $languageId,
                    'title' => $request['title'],
                ]);
            } else {
                CountryTranslation::create([
                    'country_id' => $productItem->id,
                    'language_id' => $languageId,
                    'title' => $request['title'],
                ]);
            }

            foreach ($request->post('city_title_u') as $id => $item){
                $city = City::find($id);
                $city->update([
                    'ship_price' => $request['city_price_u'][$id],
                    'code' => '',
                ]);

                $language = $city->language()->where('language_id', $languageId)->first();

                if ($language) {
                    $language->update([
                        'language_id' => $languageId,
                        'title' => $item,
                    ]);
                } else {
                    CityTranslation::create([
                        'city_id' => $city->id,
                        'language_id' => $languageId,
                        'title' => $item,
                    ]);
                }


            }
            if ($request->has('city_title')){
                foreach ($request->post('city_title') as $key => $item){
                    $city = City::create([
                        'country_id' => $productItem->id,
                        'ship_price' => $request['city_price'][$key],
                        'code' => '',
                    ]);

                    CityTranslation::create([
                        'city_id' => $city->id,
                        'language_id' => $languageId,
                        'title' => $item,
                    ]);
                }
            }



            if ($request->has('del_city')){
                foreach ($request->post('del_city') as $id){
                    City::query()->where('id',$id)->delete();
                }
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
