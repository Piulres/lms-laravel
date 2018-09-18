<?php

use Illuminate\Database\Seeder;

class ContentPageSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'About us', 'page_text' => 'Sample text', 'excerpt' => 'Sample excerpt', 'featured_image' => '',],

        ];

        foreach ($items as $item) {
            \App\ContentPage::create($item);
        }
    }
}
