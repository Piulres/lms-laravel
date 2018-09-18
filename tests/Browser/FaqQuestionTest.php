<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class FaqQuestionTest extends DuskTestCase
{

    public function testCreateFaqQuestion()
    {
        $admin = \App\User::find(1);
        $faq_question = factory('App\FaqQuestion')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $faq_question) {
            $browser->loginAs($admin)
                ->visit(route('admin.faq_questions.index'))
                ->clickLink('Add new')
                ->select("category_id", $faq_question->category_id)
                ->type("question_text", $faq_question->question_text)
                ->type("answer_text", $faq_question->answer_text)
                ->press('Save')
                ->assertRouteIs('admin.faq_questions.index')
                ->assertSeeIn("tr:last-child td[field-key='category']", $faq_question->category->title)
                ->assertSeeIn("tr:last-child td[field-key='question_text']", $faq_question->question_text)
                ->assertSeeIn("tr:last-child td[field-key='answer_text']", $faq_question->answer_text)
                ->logout();
        });
    }

    public function testEditFaqQuestion()
    {
        $admin = \App\User::find(1);
        $faq_question = factory('App\FaqQuestion')->create();
        $faq_question2 = factory('App\FaqQuestion')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $faq_question, $faq_question2) {
            $browser->loginAs($admin)
                ->visit(route('admin.faq_questions.index'))
                ->click('tr[data-entry-id="' . $faq_question->id . '"] .btn-info')
                ->select("category_id", $faq_question2->category_id)
                ->type("question_text", $faq_question2->question_text)
                ->type("answer_text", $faq_question2->answer_text)
                ->press('Update')
                ->assertRouteIs('admin.faq_questions.index')
                ->assertSeeIn("tr:last-child td[field-key='category']", $faq_question2->category->title)
                ->assertSeeIn("tr:last-child td[field-key='question_text']", $faq_question2->question_text)
                ->assertSeeIn("tr:last-child td[field-key='answer_text']", $faq_question2->answer_text)
                ->logout();
        });
    }

    public function testShowFaqQuestion()
    {
        $admin = \App\User::find(1);
        $faq_question = factory('App\FaqQuestion')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $faq_question) {
            $browser->loginAs($admin)
                ->visit(route('admin.faq_questions.index'))
                ->click('tr[data-entry-id="' . $faq_question->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='category']", $faq_question->category->title)
                ->assertSeeIn("td[field-key='question_text']", $faq_question->question_text)
                ->assertSeeIn("td[field-key='answer_text']", $faq_question->answer_text)
                ->logout();
        });
    }

}
