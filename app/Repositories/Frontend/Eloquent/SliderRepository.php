<?php

namespace App\Repositories\Frontend\Eloquent;

use App\Models\Slider;
use App\Repositories\Frontend\Eloquent\Base\BaseRepository;
use App\Repositories\Frontend\SliderRepositoryInterface;
use Illuminate\Http\Request;

class SliderRepository extends BaseRepository implements SliderRepositoryInterface
{

    public function __construct(Slider $model)
    {
        parent::__construct($model);
    }

    public function getSliders(){
        return $this->model::where(['type'=>'slider'])->with(['availableLanguage','files'])->get();
    }

}
