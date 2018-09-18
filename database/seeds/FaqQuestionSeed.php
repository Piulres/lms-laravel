<?php

use Illuminate\Database\Seeder;

class FaqQuestionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'category_id' => 1, 'question_text' => 'Sample question', 'answer_text' => 'Sample answer',],

        ];

        foreach ($items as $item) {
            \App\FaqQuestion::create($item);
        }
    }
}
