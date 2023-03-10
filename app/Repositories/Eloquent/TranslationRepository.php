<?php
/**
 *  app/Repositories/Eloquent/UserRepository.php
 *
 * Date-Time: 19.05.21
 * Time: 10:54
 * @author Insite International <hello@insite.international>
 */

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\LanguageRequest;

use App\Http\Request\Admin\TranslationRequest;
use App\Models\Language;
use App\Models\Translation;
use App\Models\User;
use App\Repositories\Eloquent\Base\BaseRepository;
use App\Repositories\TranslationRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class TranslationRepository extends BaseRepository implements TranslationRepositoryInterface
{
    /**
     * TranslationRepository constructor.
     *
     * @param User $model
     */
    public function __construct(Translation $model)
    {
        parent::__construct($model);
    }

    /**
     * TranslationRepository update.
     *
     * @param $id
     * @param
     */
    public function update($id, Request $request)
    {
        $data = $this->find($id);
        $array = $data->text;
        if ($data) {
            foreach ($request['language'] as $key => $language) {
                $array[$key] = $language;
            }
        }
        $data->text = $array;
        if ($data->save()) {
            return true;
        }
        return false;

    }

    public function getLanguages()
    {
        return Language::where(['status' => 1])->get();
    }

//    public function store(TranslationRequest $request)
//    {
//        $model = $this->model->create([
//            'group' => $request['group'],
//            'key' => $request['key'],
//            'text' => $request['language']
//        ]);
//
//        if ($model) {
//            return true;
//        }
//        return false;
//    }

    public function delete($id)
    {
        $data = $this->find($id);
        return $data ? $data->delete() : false;
    }


}
