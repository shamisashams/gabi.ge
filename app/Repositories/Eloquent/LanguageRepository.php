<?php
/**
 *  app/Repositories/Eloquent/UserRepository.php
 *
 * Date-Time: 19.05.21
 * Time: 10:54
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\LanguageRequest;
use App\Mail\SignUpMail;
use App\Mail\StatusChangeMail;
use App\Models\Language;
use App\Models\User;
use App\Models\Wallet;
use App\Repositories\DepositRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;
use App\Repositories\LanguageRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(Language $model)
    {
        parent::__construct($model);
    }

    public function update($id, LanguageRequest $request)
    {
        $request = $request->only([
            'title',
            'abbreviation',
            'native',
            'locale',
            'status',
            'default'
        ]);

        $request['status'] = isset($request['status']) ? 1 : 0;
        $request['default'] = isset($request['default']) ? 1 : 0;
        if ($request['default']) {
            $this->updateDefault();
        }
        $data = $this->find($id);
        return $data->update($request);
    }

    public function store(LanguageRequest $request)
    {

        $request = $request->only([
            'title',
            'abbreviation',
            'native',
            'locale',
            'status',
            'default'
        ]);

        $request['status'] = isset($request['status']) ? 1 : 0;
        $request['default'] = isset($request['default']) ? 1 : 0;

        return $this->model->create($request);
    }

    protected function updateDefault()
    {
        $language = Language::where('default', true)->first();
        if ($language != null) {
            $language->default = false;
            $language->save();
        }

        return true;
    }

    public function delete($id)
    {
        $data = $this->find($id);
        if ($data->default) {
            return false;
        }
        return $data->delete();
    }

}
