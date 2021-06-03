<?php

namespace App\Repositories\Eloquent;

use App\Models\Setting;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;
use App\Repositories\SettingRepositoryInterface;
use Illuminate\Http\Request;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{

    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }
    

}
