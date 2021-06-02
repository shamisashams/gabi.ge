<?php
/**
 *  app/Repositories/Eloquent/UserRepository.php
 *
 * Date-Time: 19.05.21
 * Time: 10:54
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\AnswerRequest;
use App\Models\Answer;
use App\Models\Feature;
use App\Models\Language;
use App\Models\User;
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;
use Illuminate\Support\Facades\DB;


/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class AnswerRepository extends BaseRepository implements AnswerRepositoryInterface
{
    /**
     * TranslationRepository constructor.
     *
     * @param User $model
     */
    public function __construct(Answer $model)
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

    public function store(string $lang, AnswerRequest $request)
    {
        $feature = Feature::findOrFail(intval($request['feature']));
        $success = false;
        DB::beginTransaction();

        $model = $this->model->create([
            'position' => $request['position'],
            'status' => intval($request['status']),
        ]);

        $localization = $this->getLocalization($lang);
        if ($model) {
            $answerLanguage = $model->language()->create([
                'language_id' => $localization->id,
                'title' => $request['title']
            ]);

            if ($answerLanguage) {
                $featureModel = $model->feature()->create([
                    'feature_id' => $feature->id
                ]);

                if ($request->hasFile('images') && $featureModel) {
                    foreach ($request->file('images') as $key => $file) {
                        $imagename = date('Ymhs') . $file->getClientOriginalName();
                        $destination = base_path() . '/storage/app/public/answer/' . $model->id;
                        $request->file('images')[$key]->move($destination, $imagename);
                        $model->files()->create([
                            'name' => $imagename,
                            'path' => '/storage/app/public/answer/' . $model->id,
                            'format' => $file->getClientOriginalExtension(),
                        ]);
                    }
                    $success = true;
                }
            }
        }

        $success ? DB::commit() : DB::rollBack();
        return $success;
    }

    /**
     * Update Answer item.
     *
     * @param int $id
     * @param AnswerRequest $request
     * @return bool
     */

    public function update(string $lang, int $id, AnswerRequest $request)
    {
        $feature = Feature::findOrFail(intval($request['feature']));
        $model = Answer::findOrFail(intval($id));
        $localization = $this->getLocalization($lang);
        $model->update([
            'slug' => $request['slug'],
            'position' => $request['position'],
            'status' => intval($request['status']),
        ]);

        $language = $model->language()->where('language_id', $localization->id)->first();
        if ($language) {
            $language->title = $request['title'];
            $language->save();
        } else {
            $model->language()->create([
                'language_id' => $localization->id,
                'title' => $request['title']
            ]);
        }
        if (count($model->files) > 0) {
            foreach ($model->files as $file) {
                if ($request['old_images'] == null) {
                    $file->delete();
                    continue;
                }
                if (!in_array($file->id, $request['old_images'])) {
                    if (Storage::exists('public/answer/' . $model->id . '/' . $file->name)) {
                        Storage::delete('public/answer/' . $model->id . '/' . $file->name);
                    }
                    $file->delete();

                }
            }
        }


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $imagename = date('Ymhs') . $file->getClientOriginalName();
                $destination = base_path() . '/storage/app/public/answer/' . $model->id;
                $request->file('images')[$key]->move($destination, $imagename);
                $model->files()->create([
                    'name' => $imagename,
                    'path' => '/storage/app/public/answer/' . $model->id,
                    'format' => $file->getClientOriginalExtension(),
                ]);
            }
        }


        $model->feature()->update([
            'feature_id' => $feature->id
        ]);
        return true;
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


}
