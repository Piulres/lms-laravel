<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TrailscertificateTest extends DuskTestCase
{

    public function testCreateTrailscertificate()
    {
        $admin = \App\User::find(1);
        $trailscertificate = factory('App\Trailscertificate')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $trailscertificate) {
            $browser->loginAs($admin)
                ->visit(route('admin.trailscertificates.index'))
                ->clickLink('Add new')
                ->type("order", $trailscertificate->order)
                ->type("title", $trailscertificate->title)
                ->type("slug", $trailscertificate->slug)
                ->attach("image", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.trailscertificates.index')
                ->assertSeeIn("tr:last-child td[field-key='order']", $trailscertificate->order)
                ->assertSeeIn("tr:last-child td[field-key='title']", $trailscertificate->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $trailscertificate->slug)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Trailscertificate::first()->image . "']")
                ->logout();
        });
    }

    public function testEditTrailscertificate()
    {
        $admin = \App\User::find(1);
        $trailscertificate = factory('App\Trailscertificate')->create();
        $trailscertificate2 = factory('App\Trailscertificate')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $trailscertificate, $trailscertificate2) {
            $browser->loginAs($admin)
                ->visit(route('admin.trailscertificates.index'))
                ->click('tr[data-entry-id="' . $trailscertificate->id . '"] .btn-info')
                ->type("order", $trailscertificate2->order)
                ->type("title", $trailscertificate2->title)
                ->type("slug", $trailscertificate2->slug)
                ->attach("image", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.trailscertificates.index')
                ->assertSeeIn("tr:last-child td[field-key='order']", $trailscertificate2->order)
                ->assertSeeIn("tr:last-child td[field-key='title']", $trailscertificate2->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $trailscertificate2->slug)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Trailscertificate::first()->image . "']")
                ->logout();
        });
    }

    public function testShowTrailscertificate()
    {
        $admin = \App\User::find(1);
        $trailscertificate = factory('App\Trailscertificate')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $trailscertificate) {
            $browser->loginAs($admin)
                ->visit(route('admin.trailscertificates.index'))
                ->click('tr[data-entry-id="' . $trailscertificate->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='order']", $trailscertificate->order)
                ->assertSeeIn("td[field-key='title']", $trailscertificate->title)
                ->assertSeeIn("td[field-key='slug']", $trailscertificate->slug)
                ->logout();
        });
    }

}
