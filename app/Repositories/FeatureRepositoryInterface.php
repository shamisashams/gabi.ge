<?php
/**
 *  app/Repositories/TranslationRepositoryInterface.php
 *
 * Date-Time: 19.05.21
 * Time: 10:53
 * @author Gio Bakhbaia <gbaxbaia@gmail.com>
 */

namespace App\Repositories;

use App\Http\Request\Admin\FeatureRequest;
use App\Http\Request\Admin\LanguageRequest;
use App\Http\Request\Admin\TranslationRequest;
use Illuminate\Http\Request;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories
 */
interface FeatureRepositoryInterface
{
    /**
     * @param Request $request
     */

    public function store($lang, FeatureRequest $request);

    public function update(string $lang, int $id, FeatureRequest $request);

    public function delete(int $id);
//    public function store(TranslationRequest $request);

}
