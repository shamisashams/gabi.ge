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
        $data->update([
            'slug' => $request['slug'],
            'status' => $request['status']
        ]);

        $localizationID = Language::getIdByName($locale);

        $featureLanguage = PageLanguage::where(['page_id' => $data->id, 'language_id' => $localizationID])->first();

        if ($featureLanguage == null) {
            $data->language()->create([
                'page_id' => $this->model->id,
                'language_id' => $localizationID,
                'title' => $request['title'],
                'meta_title' => $request['meta_title'],
                'description' => $request['description'],
                'content' => $request['content'],
            ]);
        } else {
            $featureLanguage->title = $request['title'];
            $featureLanguage->meta_title = $request['meta_title'];
            $featureLanguage->description = $request['description'];
            $featureLanguage->content = $request['content'];
            $featureLanguage->save();
        }

        // Delete page file if deleted in request.
        if (count($data->files) > 0) {
            foreach ($data->files as $file) {
                if ($request['old_images'] == null) {
                    $file->delete();
                    continue;
                }
                if (!in_array($file->id,$request['old_images'])) {
                    if (Storage::exists('public_html/page/' . $data->id.'/'.$file->name)) {
                        Storage::delete('public_html/page/' . $data->id.'/'.$file->name);
                    }
                    $file->delete();

                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $file) {
                $imagename = date('Ymhs') . $file->getClientOriginalName();
                $destination = base_path() . '/storage/app/public_html/page/' . $data->id;
                $request->file('images')[$key]->move($destination, $imagename);
                $data->files()->create([
                    'name' => $imagename,
                    'path' => '/storage/app/public_html/page/' . $data->id,
                    'format' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return true;

    }

}
