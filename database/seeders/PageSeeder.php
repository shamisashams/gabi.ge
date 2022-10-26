<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Pages array
        $pages = [
            [
                'status' => true,
                'title' => 'Home',
                'slug' => 'home',
                'meta_title' => 'home'
            ],
            [
                'status' => true,
                'title' => 'Warranty',
                'slug' => 'warranty',
                'meta_title' => 'warranty'
            ],
            [
                'status' => true,
                'title' => 'Contact-us',
                'slug' => 'contact-us',
                'meta_title' => 'contact'
            ],
            [
                'status' => true,
                'title' => 'About Us',
                'slug' => 'about-us',
                'meta_title' => 'about'
            ],

            [
                'status' => true,
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'meta_title' => 'Privacy'
            ],

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
