<?php
/**
 *  app/Repositories/TranslationRepositoryInterface.php
 *
 * Date-Time: 19.05.21
 * Time: 10:53
 * @author Gio Bakhbaia <gbaxbaia@gmail.com>
 */

namespace App\Repositories;

use App\Http\Request\Admin\LanguageRequest;
use App\Http\Request\Admin\TranslationRequest;
use Illuminate\Http\Request;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories
 */
interface TranslationRepositoryInterface
{
    /**
     * @param Request $request
     */

    public function getData(Request $request);

    public function update($id,Request $request);

    public function getLanguages();

//    public function store(TranslationRequest $request);

}
