<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ContentPageTest extends DuskTestCase
{

    public function testCreateContentPage()
    {
        $admin = \App\User::find(1);
        $content_page = factory('App\ContentPage')->make();

        $relations = [
            factory('App\ContentCategory')->create(), 
            factory('App\ContentCategory')->create(), 
            factory('App\ContentTag')->create(), 
            factory('App\ContentTag')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $content_page, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.content_pages.index'))
                ->clickLink('Add new')
                ->type("title", $content_page->title)
                ->select('select[name="category_id[]"]', $relations[0]->id)
                ->select('select[name="category_id[]"]', $relations[1]->id)
                ->select('select[name="tag_id[]"]', $relations[2]->id)
                ->select('select[name="tag_id[]"]', $relations[3]->id)
                ->type("page_text", $content_page->page_text)
                ->type("excerpt", $content_page->excerpt)
                ->attach("featured_image", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.content_pages.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $content_page->title)
                ->assertSeeIn("tr:last-child td[field-key='category_id'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='category_id'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='tag_id'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='tag_id'] span:last-child", $relations[3]->title)
                ->assertSeeIn("tr:last-child td[field-key='page_text']", $content_page->page_text)
                ->assertSeeIn("tr:last-child td[field-key='excerpt']", $content_page->excerpt)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\ContentPage::first()->featured_image . "']")
                ->logout();
        });
    }

    public function testEditContentPage()
    {
        $admin = \App\User::find(1);
        $content_page = factory('App\ContentPage')->create();
        $content_page2 = factory('App\ContentPage')->make();

        $relations = [
            factory('App\ContentCategory')->create(), 
            factory('App\ContentCategory')->create(), 
            factory('App\ContentTag')->create(), 
            factory('App\ContentTag')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $content_page, $content_page2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.content_pages.index'))
                ->click('tr[data-entry-id="' . $content_page->id . '"] .btn-info')
                ->type("title", $content_page2->title)
                ->select('select[name="category_id[]"]', $relations[0]->id)
                ->select('select[name="category_id[]"]', $relations[1]->id)
                ->select('select[name="tag_id[]"]', $relations[2]->id)
                ->select('select[name="tag_id[]"]', $relations[3]->id)
                ->type("page_text", $content_page2->page_text)
                ->type("excerpt", $content_page2->excerpt)
                ->attach("featured_image", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.content_pages.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $content_page2->title)
                ->assertSeeIn("tr:last-child td[field-key='category_id'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='category_id'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='tag_id'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='tag_id'] span:last-child", $relations[3]->title)
                ->assertSeeIn("tr:last-child td[field-key='page_text']", $content_page2->page_text)
                ->assertSeeIn("tr:last-child td[field-key='excerpt']", $content_page2->excerpt)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\ContentPage::first()->featured_image . "']")
                ->logout();
        });
    }

    public function testShowContentPage()
    {
        $admin = \App\User::find(1);
        $content_page = factory('App\ContentPage')->create();

        $relations = [
            factory('App\ContentCategory')->create(), 
            factory('App\ContentCategory')->create(), 
            factory('App\ContentTag')->create(), 
            factory('App\ContentTag')->create(), 
        ];

        $content_page->category_id()->attach([$relations[0]->id, $relations[1]->id]);
        $content_page->tag_id()->attach([$relations[2]->id, $relations[3]->id]);

        $this->browse(function (Browser $browser) use ($admin, $content_page, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.content_pages.index'))
                ->click('tr[data-entry-id="' . $content_page->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $content_page->title)
                ->assertSeeIn("tr:last-child td[field-key='category_id'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='category_id'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='tag_id'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='tag_id'] span:last-child", $relations[3]->title)
                ->assertSeeIn("td[field-key='page_text']", $content_page->page_text)
                ->assertSeeIn("td[field-key='excerpt']", $content_page->excerpt)
                ->logout();
        });
    }

}
