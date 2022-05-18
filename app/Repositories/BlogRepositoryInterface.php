<?php
/**
 *  app/Repositories/TranslationRepositoryInterface.php
 *
 * Date-Time: 19.05.21
 * Time: 10:53
 * @author Gio Bakhbaia <gbaxbaia@gmail.com>
 */

namespace App\Repositories;


use App\Http\Request\Admin\BlogRequest;
use Illuminate\Http\Request;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories
 */
interface BlogRepositoryInterface
{
    /**
     * @param Request $request
     */

    public function store(string $lang, BlogRequest $request);

    public function update(string $lang, int $id, BlogRequest $request);

    public function delete(int $id);

}
