<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class ProductPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $pages = [
            [
                'status' => true,
                'title' => 'products',
                'slug' => 'products',
                'meta_title' => 'products'
            ]
        ];

        foreach ($pages as $page) {
            $model = new Page();
            $model->status = $page['status'];
            $model->save();
            $model->language()->create([
                'page_id' => $model->id,
                'language_id' => '2',
                'title' => $page['title'],
                'slug' => $page['slug'],
                'meta_title' => $page['meta_title']
            ]);
        }
    }
}
