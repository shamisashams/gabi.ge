<?php

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\SettingRequest;
use App\Models\Language;
use App\Models\Setting;
use App\Models\SettingLanguage;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;
use App\Repositories\SettingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{

    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    /**
     * Update Answer item.
     *
     * @param int $id
     * @param SettingRequest $request
     * @return bool
     */

    public function update(string $locale, SettingRequest $request, int $id)
    {
        $data = $this->find($id);

        $localizationID = Language::getIdByName($locale);

        $featureLanguage = SettingLanguage::where(['setting_id' => $data->id, 'language_id' => $localizationID])->first();

        try {
            DB::beginTransaction();
            if ($featureLanguage == null) {
                $data->language()->create([
                    'setting_id' => $data->id,
                    'language_id' => $localizationID,
                    'value' => $request['value']
                ]);
            } else {
                $featureLanguage->value = $request['value'];
                $featureLanguage->save();
            }
            DB::commit();
            return true;
        } catch (\Exception $queryException) {
            DB::rollBack();
            return false;
        }

    }

}
