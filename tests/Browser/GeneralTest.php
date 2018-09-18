<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class GeneralTest extends DuskTestCase
{

    public function testCreateGeneral()
    {
        $admin = \App\User::find(1);
        $general = factory('App\General')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $general) {
            $browser->loginAs($admin)
                ->visit(route('admin.generals.index'))
                ->clickLink('Add new')
                ->type("site_name", $general->site_name)
                ->attach("site_logo", base_path("tests/_resources/test.jpg"))
                ->radio("theme_color", $general->theme_color)
                ->press('Save')
                ->assertRouteIs('admin.generals.index')
                ->assertSeeIn("tr:last-child td[field-key='site_name']", $general->site_name)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\General::first()->site_logo . "']")
                ->assertSeeIn("tr:last-child td[field-key='theme_color']", $general->theme_color)
                ->logout();
        });
    }

    public function testEditGeneral()
    {
        $admin = \App\User::find(1);
        $general = factory('App\General')->create();
        $general2 = factory('App\General')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $general, $general2) {
            $browser->loginAs($admin)
                ->visit(route('admin.generals.index'))
                ->click('tr[data-entry-id="' . $general->id . '"] .btn-info')
                ->type("site_name", $general2->site_name)
                ->attach("site_logo", base_path("tests/_resources/test.jpg"))
                ->radio("theme_color", $general2->theme_color)
                ->press('Update')
                ->assertRouteIs('admin.generals.index')
                ->assertSeeIn("tr:last-child td[field-key='site_name']", $general2->site_name)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\General::first()->site_logo . "']")
                ->assertSeeIn("tr:last-child td[field-key='theme_color']", $general2->theme_color)
                ->logout();
        });
    }

    public function testShowGeneral()
    {
        $admin = \App\User::find(1);
        $general = factory('App\General')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $general) {
            $browser->loginAs($admin)
                ->visit(route('admin.generals.index'))
                ->click('tr[data-entry-id="' . $general->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='site_name']", $general->site_name)
                ->assertSeeIn("td[field-key='theme_color']", $general->theme_color)
                ->logout();
        });
    }

}
