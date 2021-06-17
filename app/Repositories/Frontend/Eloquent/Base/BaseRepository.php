<?php
/**
 *  app/Repositories/Eloquent/Base/BaseRepository.php
 *
 * Date-Time: 19.05.21
 * Time: 09:46
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Repositories\Frontend\Eloquent\Base;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Paginate all
     *
     * @param integer $perPage
     * @param array $columns
     *
     * @return Paginator
     */
    public function paginate($perPage = 15, $columns = ['*']): Paginator
    {
        return $this->model->paginate($perPage, $columns);
    }

    /** Get Data with pagination
     *
     * @param $request
     * @return mixed
     */
    public function getData($request, array $relation = [], $paginate = true)
    {
        $data = $this->model->filter($request);

        $perPage = 10;

        if ($request->filled('per_page')) {
            $perPage = $request['per_page'];
        }

        if (!$paginate) {
            return $data->with($relation);
        }
        return $data->with($relation)->paginate($perPage);
    }

    /**
     * Find model by the given ID
     *
     * @param integer $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find(int $id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }
}
