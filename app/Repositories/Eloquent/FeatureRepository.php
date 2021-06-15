<?php
/**
 *  app/Repositories/Eloquent/UserRepository.php
 *
 * Date-Time: 19.05.21
 * Time: 10:54
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\FeatureRequest;
use App\Http\Request\Admin\LanguageRequest;

use App\Http\Request\Admin\TranslationRequest;
use App\Models\Feature;
use App\Models\FeatureLanguage;
use App\Models\Language;
use App\Models\Translation;
use App\Models\User;
use App\Repositories\Eloquent\Base\BaseRepository;
use App\Repositories\FeatureRepositoryInterface;
use App\Repositories\TranslationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class FeatureRepository extends BaseRepository implements FeatureRepositoryInterface
{
    /**
     * TranslationRepository constructor.
     *
     * @param User $model
     */
    public function __construct(Feature $model)
    {
        parent::__construct($model);
    }

    public function store($lang, $request)
    {
        $data = $request->only([
            'title',
            'position',
            'slug',
            'type',
            'status'
        ]);
        $data['status'] = isset($data['status']) ? 1 : 0;

        $localizationID = Language::getIdByName($lang);

        DB::beginTransaction();

        $model = $this->model->create([
            'position' => $data['position'],
            'status' => $data['status'],
            'type' => $data['type']
        ]);

        if ($model) {
            $featureLanguage = $model->language()->create([
                'feature_id' => $model->id,
                'language_id' => $localizationID,
                'title' => $data['title'],
            ]);
            if ($featureLanguage) {
                DB::commit();
                return true;
            }
            DB::rollBack();
            return false;
        }

        return false;
    }

    public function update(string $lang, int $id, FeatureRequest $request)
    {

        $request = $request->only([
            'title',
            'position',
            'slug',
            'type',
            'status'
        ]);

        $request['status'] = isset($request['status']) ? 1 : 0;

        $data = $this->find($id);
        $success = false;

        DB::beginTransaction();

        $feature = $data->update([
            'position' => $request['position'],
            'status' => $request['status'],
            'type' => $request['type']
        ]);

        $localizationID = Language::getIdByName($lang);

        $featureLanguage = FeatureLanguage::where(['feature_id' => $data->id, 'language_id' => $localizationID])->first();


        if ($feature) {
            if ($featureLanguage == null) {
                $model = $data->language()->create([
                    'feature_id' => $data->id,
                    'language_id' => $localizationID,
                    'title' => $request['title'],
                ]);
                if ($model) {
                    $success = true;
                }

            } else {
                $featureLanguage->title = $request['title'];
                if ($featureLanguage->save()) {
                    $success = true;
                }
            }
        }

        $success ? DB::commit() : DB::rollBack();
        return (bool)$success;
    }

    public function delete(int $id)
    {
        $data = $this->find($id);
        return $data->delete();
    }

}
