<?php
/**
 *  app/Repositories/TranslationRepositoryInterface.php
 *
 * Date-Time: 19.05.21
 * Time: 10:53
 * @author Gio Bakhbaia <gbaxbaia@gmail.com>
 */

namespace App\Repositories;

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

    public function getData(Request $request);

}
