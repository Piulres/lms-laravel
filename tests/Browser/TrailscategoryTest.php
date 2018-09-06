<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TrailscategoryTest extends DuskTestCase
{

    public function testCreateTrailscategory()
    {
        $admin = \App\User::find(1);
        $trailscategory = factory('App\Trailscategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $trailscategory) {
            $browser->loginAs($admin)
                ->visit(route('admin.trailscategories.index'))
                ->clickLink('Add new')
                ->type("title", $trailscategory->title)
                ->press('Save')
                ->assertRouteIs('admin.trailscategories.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $trailscategory->title)
                ->logout();
        });
    }

    public function testEditTrailscategory()
    {
        $admin = \App\User::find(1);
        $trailscategory = factory('App\Trailscategory')->create();
        $trailscategory2 = factory('App\Trailscategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $trailscategory, $trailscategory2) {
            $browser->loginAs($admin)
                ->visit(route('admin.trailscategories.index'))
                ->click('tr[data-entry-id="' . $trailscategory->id . '"] .btn-info')
                ->type("title", $trailscategory2->title)
                ->press('Update')
                ->assertRouteIs('admin.trailscategories.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $trailscategory2->title)
                ->logout();
        });
    }

    public function testShowTrailscategory()
    {
        $admin = \App\User::find(1);
        $trailscategory = factory('App\Trailscategory')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $trailscategory) {
            $browser->loginAs($admin)
                ->visit(route('admin.trailscategories.index'))
                ->click('tr[data-entry-id="' . $trailscategory->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $trailscategory->title)
                ->logout();
        });
    }

}
