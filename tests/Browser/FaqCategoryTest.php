<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class FaqCategoryTest extends DuskTestCase
{

    public function testCreateFaqCategory()
    {
        $admin = \App\User::find(1);
        $faq_category = factory('App\FaqCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $faq_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.faq_categories.index'))
                ->clickLink('Add new')
                ->type("title", $faq_category->title)
                ->press('Save')
                ->assertRouteIs('admin.faq_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $faq_category->title)
                ->logout();
        });
    }

    public function testEditFaqCategory()
    {
        $admin = \App\User::find(1);
        $faq_category = factory('App\FaqCategory')->create();
        $faq_category2 = factory('App\FaqCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $faq_category, $faq_category2) {
            $browser->loginAs($admin)
                ->visit(route('admin.faq_categories.index'))
                ->click('tr[data-entry-id="' . $faq_category->id . '"] .btn-info')
                ->type("title", $faq_category2->title)
                ->press('Update')
                ->assertRouteIs('admin.faq_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $faq_category2->title)
                ->logout();
        });
    }

    public function testShowFaqCategory()
    {
        $admin = \App\User::find(1);
        $faq_category = factory('App\FaqCategory')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $faq_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.faq_categories.index'))
                ->click('tr[data-entry-id="' . $faq_category->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $faq_category->title)
                ->logout();
        });
    }

}
