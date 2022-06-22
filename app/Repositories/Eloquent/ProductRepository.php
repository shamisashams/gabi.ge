<?php

namespace App\Repositories\Eloquent;

use App\Models\FileLanguage;
use App\Models\ProductAnswers;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Traits\RequestFilter;
use App\Http\Request\Admin\ProductRequest;
use Illuminate\Support\Facades\DB;
use App\Models\ProductLanguage;
use App\Models\Language;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\SaleProduct;
use Gumlet\ImageResize;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    use RequestFilter;

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }


    public function update(string $lang, int $id, ProductRequest $request)
    {


        $request['status'] = isset($request['status']) ? 1 : 0;
        try {
            DB::beginTransaction();

            $productItem = $this->find($id);

            $productItem->update([
                'status' => $request['status'],
                'category_id' => $request['category_id'],
                'price' => $request['price'],
                'weight' => $request['weight']
            ]);

            $languageId = Language::getIdByName($lang);
            $language = $productItem->language()->where('language_id', $languageId)->first();
            if ($language) {
                $language->update([
                    'language_id' => $languageId,
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'slug' => $request['slug'],
                    'short_description' => $request['short_description'],
                    'shipping' => $request['shipping'],
                    'meta_title' => $request['meta_title'],
                    'meta_description' => $request['meta_description'],
                    'meta_keyword' => $request['meta_keyword'],
                ]);
            } else {
                ProductLanguage::create([
                    'product_id' => $productItem->id,
                    'language_id' => $languageId,
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'slug' => $request['slug'],
                    'short_description' => $request['short_description'],
                    'shipping' => $request['shipping'],
                    'meta_title' => $request['meta_title'],
                    'meta_description' => $request['meta_description'],
                    'meta_keyword' => $request['meta_keyword'],
                ]);
            }

            $this->updateProductAnswers($request, $productItem);

            $this->updateSaleProduct($request, $productItem);

            $this->updateImages($request, $productItem, $lang);

            DB::commit();
            return true;

        } catch (\Exception $queryException) {
            DB::rollBack();
            dd($queryException->getMessage());
            return false;
        }
    }

    public function store(string $lang, ProductRequest $request)
    {
        $request['status'] = isset($request['status']) ? 1 : 0;
        // Create new item


        try {
            DB::beginTransaction();

            $productItem = $this->model->create([
                'status' => $request['status'],
                'category_id' => $request['category_id'],
                'price' => $request['price'],
                'weight' => $request['weight']
            ]);

            /// Save with correct language
            $languageId = Language::getIdByName($lang);

            ProductLanguage::create([
                'product_id' => $productItem->id,
                'language_id' => $languageId,
                'title' => $request['title'],
                'description' => $request['description'],
                'slug' => $request['slug'],
                'short_description' => $request['short_description'],
                'shipping' => $request['shipping'],
                'meta_title' => $request['meta_title'],
                'meta_description' => $request['meta_description'],
                'meta_keyword' => $request['meta_keyword'],
            ]);


            $this->saveProductAnswers($request, $productItem);

            $this->saveSaleProduct($request, $productItem);


            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $file) {

                    $image = new ImageResize($file);
                    $image->resizeToHeight(360);

                    $image->crop(360, 360, true, ImageResize::CROPCENTER);
                    //$image->save(date('Ymhs') . $file->getClientOriginalName());
                    $img = $image->getImageAsString();

                    $imagename = str_replace(' ','_',$file->getClientOriginalName());
                    $destination = base_path() . '/storage/app/public/product/' . $productItem->id;
                    $thumb = 'public/product/' . $productItem->id .'/thumb/'.$imagename;
                    $request->file('images')[$key]->move($destination, $imagename);
                    Storage::put($thumb,$img);
                    $productItem->files()->create([
                        'name' => $imagename,
                        'path' => '/storage/app/public/product/' . $productItem->id,
                        'format' => $file->getClientOriginalExtension(),
                    ]);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $queryException) {
            DB::rollBack();
            return false;
        }
    }


    public function getSingleProductFeatures(int $id)
    {
        $filterData = ProductAnswers::with(['feature.availableLanguage', 'feature.answer.availableLanguage', 'feature.englishLanguage'])->where('product_id', $id);

        $productFeatures = $filterData
            ->groupBy('feature_id')
            ->get()
            ->sortBy(function ($query) {
                return $query->feature->position;
            });


        $productAnswers = $filterData->groupBy('answer_id')->get()->pluck('answer_id')->toArray();

        return [
            'productFeatures' => $productFeatures,
            'productAnswers' => $productAnswers
        ];
    }


    protected function saveProductAnswers($request, $productItem)
    {

        if ($request['answer']) {
            foreach ($request['answer'] as $key => $answers) {
                foreach ($answers as $answer) {
                    $data[] =
                        [
                            'product_id' => $productItem->id,
                            'feature_id' => $key,
                            'answer_id' => $answer,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                }
            }
            ProductAnswers::insert($data);
        }

    }


    protected function saveSaleProduct($request, $productItems)
    {
        if ($request['sale']) {
            SaleProduct::create([
                'sale_id' => $request['sale'],
                'product_id' => $productItems->id,
            ]);
        }
    }

    protected function updateProductAnswers($request, $productItem)
    {
        $featuresId = ProductAnswers::where(['product_id' => $productItem->id])->groupBy('feature_id')->pluck('feature_id')->toArray();
        $answersId = ProductAnswers::where(['product_id' => $productItem->id])->groupBy('answer_id')->pluck('answer_id')->toArray();
        $arrayAnswers = $answersId;
        $arrayFeatures = $featuresId;
        $data = [];
        if ($request['answer']) {
            foreach ($request['answer'] as $key => $answers) {
                foreach ($answers as $answer) {

                    $isAnswer = in_array($answer, $answersId);
                    $isFeature = in_array($key, $featuresId);

                    if (!$isFeature || !$isAnswer) {
                        $data[] =
                            [
                                'product_id' => $productItem->id,
                                'feature_id' => $key,
                                'answer_id' => $answer,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ];
                    }

                    if ($isFeature) {
                        $featureKey = array_search($key, $arrayFeatures);
                        array_splice($arrayFeatures, $featureKey, 1);
                    }
                    if ($isAnswer) {
                        $answerKey = array_search($answer, $arrayAnswers);
                        array_splice($arrayAnswers, $answerKey, 1);
                    }

                }
            }

            count($arrayAnswers) > 0 ? ProductAnswers::where(['product_id' => $productItem->id])->whereIn('answer_id', $arrayAnswers)->delete() : "";
            count($arrayFeatures) > 0 ? ProductAnswers::where(['product_id' => $productItem->id])->whereIn('feature_id', $arrayFeatures)->delete() : "";
            count($data) > 0 ? ProductAnswers::insert($data) : "";
        } else {
            $productItem->answers()->delete();
        }
    }

    protected function updateSaleProduct($request, $productItems)
    {

        if ($request['sale']) {
            if ($productItems->saleProduct) {
                $productItems->saleProduct()->update([
                    'sale_id' => $request['sale'],
                    'product_id' => $productItems->id,
                ]);
            } else {
                SaleProduct::create([
                    'sale_id' => $request['sale'],
                    'product_id' => $productItems->id,
                ]);
            }
        } else {
            $productItems->saleProduct()->delete();
        }
    }


    public function updateImages($request, $model, $lang)
    {
        $languageId = Language::getIdByName($lang);
        //dd($request->all());
        if (count($model->files) > 0) {
            foreach ($model->files as $file) {
                if ($request['old_images'] == null) {
                    if (Storage::exists('public/product/' . $model->id . '/' . $file->name)) {
                        Storage::delete('public/product/' . $model->id . '/' . $file->name);
                    }
                    if (Storage::exists('public/product/' . $model->id . '/thumb/' . $file->name)) {
                        Storage::delete('public/product/' . $model->id . '/thumb/' . $file->name);
                    }
                    $file->delete();
                    continue;
                }
                if (!in_array($file->id, $request['old_images'])) {
                    if (Storage::exists('public/product/' . $model->id . '/' . $file->name)) {
                        Storage::delete('public/product/' . $model->id . '/' . $file->name);
                    }
                    if (Storage::exists('public/product/' . $model->id . '/thumb/' . $file->name)) {
                        Storage::delete('public/product/' . $model->id . '/thumb/' . $file->name);
                    }
                    $file->delete();


                }

                $language = $file->languages()->where('language_id', $languageId)->first();
                //dd($language);
                if ($language) {
                    $language->update([
                        'language_id' => $languageId,
                        'title' => $request['alt'][$file->id],
                    ]);
                } else {
                    //dd($file->id);
                    FileLanguage::create([
                        'file_id' => $file->id,
                        'language_id' => $languageId,
                        'title' => $request['alt'][$file->id],

                    ]);
                }
            }
        }


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $image = new ImageResize($file);
                $image->resizeToHeight(360);

                $image->crop(360, 360, true, ImageResize::CROPCENTER);
                //$image->save(date('Ymhs') . $file->getClientOriginalName());
                $img = $image->getImageAsString();



                $imagename = str_replace(' ','_',$file->getClientOriginalName());
                $destination = base_path() . '/storage/app/public/product/' . $model->id;
                $thumb = 'public/product/' . $model->id .'/thumb/'.$imagename;
                $request->file('images')[$key]->move($destination, $imagename);
                Storage::put($thumb,$img);
                $model->files()->create([
                    'name' => $imagename,
                    'path' => '/storage/app/public/product/' . $model->id,
                    'format' => $file->getClientOriginalExtension(),
                ]);
            }
        }

    }

    public function delete(int $id)
    {
        $model = $this->find($id);
        foreach ($model->files as $file){

            if (Storage::exists('public/product/' . $model->id . '/' . $file->name)) {
                Storage::delete('public/product/' . $model->id . '/' . $file->name);
            }
            if (Storage::exists('public/product/' . $model->id . '/thumb/' . $file->name)) {
                Storage::delete('public/product/' . $model->id . '/thumb/' . $file->name);
            }
            $file->delete();
        }
        return $model->delete();
    }
//
//     protected function setOldImagesOfProduct(ProductRequest $request, Product $product)
//     {
//         if (!count($product->files)) {
//             return $this;
//         }
//
//         foreach ($product->files as $productFileItem) {
//
//             if (is_null($request['old_images'])) {
//                 $this->removeProductImage($productFileItem);
//                 continue;
//             }
//
//             if (in_array($productFileItem->id, $request['old_images'])) {
//                 continue;
//             }
//
//             $this->removeProductImage($productFileItem);
//         }
//
//         return $this;
//     }
//


}
