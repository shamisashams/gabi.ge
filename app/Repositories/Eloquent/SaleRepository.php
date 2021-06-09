<?php

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\SaleRequest;
use App\Http\Request\Admin\SettingRequest;
use App\Models\Language;
use App\Models\Sale;
use App\Models\SaleLanguage;
use App\Models\Setting;
use App\Models\SettingLanguage;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;
use App\Repositories\SaleRepositoryInterface;
use App\Repositories\SettingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class SaleRepository extends BaseRepository implements SaleRepositoryInterface
{

    public function __construct(Sale $model)
    {
        parent::__construct($model);
    }

    /**
     * Create Sale item.
     *
     * @param string $request
     * @param SettingRequest $request
     * @return bool
     */
    public function store(string $locale, SaleRequest $request)
    {

        try {
            DB::beginTransaction();

            $model = $this->model->create([
                'discount' => $request['discount'],
                'type' => $request['type']
            ]);

            $localizationID = Language::getIdByName($locale);
            $model->language()->create([
                'title' => $request['title'],
                'sale_id' => $model->id,
                'language_id' => $localizationID,
            ]);

            DB::commit();
            return true;

        } catch (\Exception $dbException) {
            DB::rollBack();
            return false;
        }
    }

    public function update(string $locale, int $id, SaleRequest $request)
    {
        $data = $this->find($id);
        try {
            DB::beginTransaction();

            $data->update([
                'discount' => $request['discount'],
                'type' => $request['type']
            ]);

            $localizationID = Language::getIdByName($locale);

            $saleLanguage = SaleLanguage::where(['sale_id' => $data->id, 'language_id' => $localizationID])->first();

            if ($saleLanguage == null) {
                $data->language()->create([
                    'sale_id' => $data->id,
                    'language_id' => $localizationID,
                    'title' => $request['title'],
                ]);
            } else {
                $saleLanguage->title = $request['title'];
                $saleLanguage->save();
            }

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
        return $data ? $data->delete() : false;

    }

}
