<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ContentCategoryTest extends DuskTestCase
{

    public function testCreateContentCategory()
    {
        $admin = \App\User::find(1);
        $content_category = factory('App\ContentCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $content_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.content_categories.index'))
                ->clickLink('Add new')
                ->type("title", $content_category->title)
                ->type("slug", $content_category->slug)
                ->press('Save')
                ->assertRouteIs('admin.content_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $content_category->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $content_category->slug)
                ->logout();
        });
    }

    public function testEditContentCategory()
    {
        $admin = \App\User::find(1);
        $content_category = factory('App\ContentCategory')->create();
        $content_category2 = factory('App\ContentCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $content_category, $content_category2) {
            $browser->loginAs($admin)
                ->visit(route('admin.content_categories.index'))
                ->click('tr[data-entry-id="' . $content_category->id . '"] .btn-info')
                ->type("title", $content_category2->title)
                ->type("slug", $content_category2->slug)
                ->press('Update')
                ->assertRouteIs('admin.content_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $content_category2->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $content_category2->slug)
                ->logout();
        });
    }

    public function testShowContentCategory()
    {
        $admin = \App\User::find(1);
        $content_category = factory('App\ContentCategory')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $content_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.content_categories.index'))
                ->click('tr[data-entry-id="' . $content_category->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $content_category->title)
                ->assertSeeIn("td[field-key='slug']", $content_category->slug)
                ->logout();
        });
    }

}
