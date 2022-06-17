<?php

namespace App\Repositories\Eloquent;

use App\Http\Request\Admin\PageRequest;
use App\Models\Language;
use App\Models\Page;
use App\Models\PageLanguage;
use App\Repositories\PageRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\Eloquent\Base\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{

    public function __construct(Page $model)
    {
        parent::__construct($model);
    }

    public function update(string $locale, int $id, PageRequest $request)
    {

        $request['status'] = isset($request['status']) ? 1 : 0;
        $data = $this->find($id);

        try {
            DB::beginTransaction();
            $data->update([
                'status' => $request['status'],
                'h_tag' => $request['h_tag'],
            ]);

            $localizationID = Language::getIdByName($locale);

            $pageLanguage = PageLanguage::where(['page_id' => $data->id, 'language_id' => $localizationID])->first();

            if ($pageLanguage == null) {
                $data->language()->create([
                    'page_id' => $data->id,
                    'language_id' => $localizationID,
                    'slug' => $request['slug'],
                    'title' => $request['title'],
                    'meta_title' => $request['meta_title'],
                    'meta_description' => $request['meta_description'],
                    'meta_keyword' => $request['meta_keyword'],
                    'content' => $request['content'],
                    'content_2' => $request['content_2'],
                    'content_3' => $request['content_3'],
                ]);
            } else {
                $pageLanguage->title = $request['title'];
                $pageLanguage->meta_title = $request['meta_title'];
                $pageLanguage->meta_description = $request['meta_description'];
                $pageLanguage->meta_keyword = $request['meta_keyword'];
                $pageLanguage->slug = $request['slug'];
                $pageLanguage->content = $request['content'];
                $pageLanguage->content_2 = $request['content_2'];
                $pageLanguage->content_3 = $request['content_3'];
                $pageLanguage->save();
            }

            // Delete page file if deleted in request.
            if (count($data->files) > 0) {
                foreach ($data->files as $file) {
                    if ($request['old_images'] == null) {
                        if (Storage::exists('public/page/' . $data->id . '/' . $file->name)) {
                            Storage::delete('public/page/' . $data->id . '/' . $file->name);
                        }
                        $file->delete();
                        continue;
                    }
                    if (!in_array($file->id, $request['old_images'])) {
                        if (Storage::exists('public/page/' . $data->id . '/' . $file->name)) {
                            Storage::delete('public/page/' . $data->id . '/' . $file->name);
                        }
                        $file->delete();

                    }
                }
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $file) {
                    $imagename = date('Ymhs') . $file->getClientOriginalName();
                    $destination = base_path() . '/storage/app/public/page/' . $data->id;
                    $request->file('images')[$key]->move($destination, $imagename);
                    $data->files()->create([
                        'name' => $imagename,
                        'path' => '/storage/app/public/page/' . $data->id,
                        'format' => $file->getClientOriginalExtension(),
                    ]);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $dbException) {
            DB::rollBack();
            return false;
        }

    }

}
