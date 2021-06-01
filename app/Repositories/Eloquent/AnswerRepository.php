<?php
/**
 *  app/Repositories/Eloquent/UserRepository.php
 *
 * Date-Time: 19.05.21
 * Time: 10:54
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Repositories\Eloquent;

use App\Models\Answer;
use App\Models\Feature;
use App\Models\User;
use App\Repositories\AnswerRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;


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


}
