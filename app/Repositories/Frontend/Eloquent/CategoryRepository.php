<?php

namespace App\Repositories\Frontend\Eloquent;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Frontend\CategoryRepositoryInterface;
use App\Repositories\Frontend\Eloquent\Base\BaseRepository;
use Illuminate\Http\Request;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getMainCategories(){
        return $this->model::with(['availableLanguage'])->byMain()->take(10)->get();
    }
}
