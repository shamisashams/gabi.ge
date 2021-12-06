<?php
/**
 *  app/Repositories/UserRepositoryInterface.php
 *
 * Date-Time: 19.05.21
 * Time: 10:53
 * @author Insite International <hello@insite.international>
 */

namespace App\Repositories;

use App\Http\Request\Admin\LanguageRequest;
use Illuminate\Http\Request;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories
 */
interface LanguageRepositoryInterface
{
    /**
     * @param Request $request
     */

    public function getData(Request $request);

    public function update($id,LanguageRequest $request);

    public function store(LanguageRequest $request);

    public function delete($id);

}
