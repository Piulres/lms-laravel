<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ContentTagTest extends DuskTestCase
{

    public function testCreateContentTag()
    {
        $admin = \App\User::find(1);
        $content_tag = factory('App\ContentTag')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $content_tag) {
            $browser->loginAs($admin)
                ->visit(route('admin.content_tags.index'))
                ->clickLink('Add new')
                ->type("title", $content_tag->title)
                ->type("slug", $content_tag->slug)
                ->press('Save')
                ->assertRouteIs('admin.content_tags.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $content_tag->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $content_tag->slug)
                ->logout();
        });
    }

    public function testEditContentTag()
    {
        $admin = \App\User::find(1);
        $content_tag = factory('App\ContentTag')->create();
        $content_tag2 = factory('App\ContentTag')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $content_tag, $content_tag2) {
            $browser->loginAs($admin)
                ->visit(route('admin.content_tags.index'))
                ->click('tr[data-entry-id="' . $content_tag->id . '"] .btn-info')
                ->type("title", $content_tag2->title)
                ->type("slug", $content_tag2->slug)
                ->press('Update')
                ->assertRouteIs('admin.content_tags.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $content_tag2->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $content_tag2->slug)
                ->logout();
        });
    }

    public function testShowContentTag()
    {
        $admin = \App\User::find(1);
        $content_tag = factory('App\ContentTag')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $content_tag) {
            $browser->loginAs($admin)
                ->visit(route('admin.content_tags.index'))
                ->click('tr[data-entry-id="' . $content_tag->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $content_tag->title)
                ->assertSeeIn("td[field-key='slug']", $content_tag->slug)
                ->logout();
        });
    }

}
