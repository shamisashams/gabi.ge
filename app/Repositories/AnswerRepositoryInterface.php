<?php
/**
 *  app/Repositories/TranslationRepositoryInterface.php
 *
 * Date-Time: 19.05.21
 * Time: 10:53
 * @author Gio Bakhbaia <gbaxbaia@gmail.com>
 */

namespace App\Repositories;

use App\Http\Request\Admin\AnswerRequest;
use Illuminate\Http\Request;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories
 */
interface AnswerRepositoryInterface
{
    /**
     * @param Request $request
     */

    public function store(string $lang, AnswerRequest $request);

    public function update(string $lang, int $id, AnswerRequest $request);

    public function delete(int $id);

}
