<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TrailcategoryTest extends DuskTestCase
{

    public function testCreateTrailcategory()
    {
        $admin = \App\User::find(1);
        $trailcategory = factory('App\Trailcategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $trailcategory) {
            $browser->loginAs($admin)
                ->visit(route('admin.trailcategories.index'))
                ->clickLink('Add new')
                ->type("title", $trailcategory->title)
                ->type("slug", $trailcategory->slug)
                ->press('Save')
                ->assertRouteIs('admin.trailcategories.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $trailcategory->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $trailcategory->slug)
                ->logout();
        });
    }

    public function testEditTrailcategory()
    {
        $admin = \App\User::find(1);
        $trailcategory = factory('App\Trailcategory')->create();
        $trailcategory2 = factory('App\Trailcategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $trailcategory, $trailcategory2) {
            $browser->loginAs($admin)
                ->visit(route('admin.trailcategories.index'))
                ->click('tr[data-entry-id="' . $trailcategory->id . '"] .btn-info')
                ->type("title", $trailcategory2->title)
                ->type("slug", $trailcategory2->slug)
                ->press('Update')
                ->assertRouteIs('admin.trailcategories.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $trailcategory2->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $trailcategory2->slug)
                ->logout();
        });
    }

    public function testShowTrailcategory()
    {
        $admin = \App\User::find(1);
        $trailcategory = factory('App\Trailcategory')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $trailcategory) {
            $browser->loginAs($admin)
                ->visit(route('admin.trailcategories.index'))
                ->click('tr[data-entry-id="' . $trailcategory->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $trailcategory->title)
                ->assertSeeIn("td[field-key='slug']", $trailcategory->slug)
                ->logout();
        });
    }

}
