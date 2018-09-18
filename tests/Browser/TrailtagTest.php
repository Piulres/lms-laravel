<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TrailtagTest extends DuskTestCase
{

    public function testCreateTrailtag()
    {
        $admin = \App\User::find(1);
        $trailtag = factory('App\Trailtag')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $trailtag) {
            $browser->loginAs($admin)
                ->visit(route('admin.trailtags.index'))
                ->clickLink('Add new')
                ->type("title", $trailtag->title)
                ->type("slug", $trailtag->slug)
                ->press('Save')
                ->assertRouteIs('admin.trailtags.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $trailtag->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $trailtag->slug)
                ->logout();
        });
    }

    public function testEditTrailtag()
    {
        $admin = \App\User::find(1);
        $trailtag = factory('App\Trailtag')->create();
        $trailtag2 = factory('App\Trailtag')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $trailtag, $trailtag2) {
            $browser->loginAs($admin)
                ->visit(route('admin.trailtags.index'))
                ->click('tr[data-entry-id="' . $trailtag->id . '"] .btn-info')
                ->type("title", $trailtag2->title)
                ->type("slug", $trailtag2->slug)
                ->press('Update')
                ->assertRouteIs('admin.trailtags.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $trailtag2->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $trailtag2->slug)
                ->logout();
        });
    }

    public function testShowTrailtag()
    {
        $admin = \App\User::find(1);
        $trailtag = factory('App\Trailtag')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $trailtag) {
            $browser->loginAs($admin)
                ->visit(route('admin.trailtags.index'))
                ->click('tr[data-entry-id="' . $trailtag->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $trailtag->title)
                ->assertSeeIn("td[field-key='slug']", $trailtag->slug)
                ->logout();
        });
    }

}
