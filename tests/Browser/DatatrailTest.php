<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DatatrailTest extends DuskTestCase
{

    public function testCreateDatatrail()
    {
        $admin = \App\User::find(1);
        $datatrail = factory('App\Datatrail')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $datatrail) {
            $browser->loginAs($admin)
                ->visit(route('admin.datatrails.index'))
                ->clickLink('Add new')
                ->select("trail_id", $datatrail->trail_id)
                ->select("user_id", $datatrail->user_id)
                ->check("view")
                ->type("progress", $datatrail->progress)
                ->type("rating", $datatrail->rating)
                ->press('Save')
                ->assertRouteIs('admin.datatrails.index')
                ->assertSeeIn("tr:last-child td[field-key='trail']", $datatrail->trail->title)
                ->assertSeeIn("tr:last-child td[field-key='user']", $datatrail->user->name)
                ->assertChecked("view")
                ->assertSeeIn("tr:last-child td[field-key='progress']", $datatrail->progress)
                ->assertSeeIn("tr:last-child td[field-key='rating']", $datatrail->rating)
                ->logout();
        });
    }

    public function testEditDatatrail()
    {
        $admin = \App\User::find(1);
        $datatrail = factory('App\Datatrail')->create();
        $datatrail2 = factory('App\Datatrail')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $datatrail, $datatrail2) {
            $browser->loginAs($admin)
                ->visit(route('admin.datatrails.index'))
                ->click('tr[data-entry-id="' . $datatrail->id . '"] .btn-info')
                ->select("trail_id", $datatrail2->trail_id)
                ->select("user_id", $datatrail2->user_id)
                ->check("view")
                ->type("progress", $datatrail2->progress)
                ->type("rating", $datatrail2->rating)
                ->press('Update')
                ->assertRouteIs('admin.datatrails.index')
                ->assertSeeIn("tr:last-child td[field-key='trail']", $datatrail2->trail->title)
                ->assertSeeIn("tr:last-child td[field-key='user']", $datatrail2->user->name)
                ->assertChecked("view")
                ->assertSeeIn("tr:last-child td[field-key='progress']", $datatrail2->progress)
                ->assertSeeIn("tr:last-child td[field-key='rating']", $datatrail2->rating)
                ->logout();
        });
    }

    public function testShowDatatrail()
    {
        $admin = \App\User::find(1);
        $datatrail = factory('App\Datatrail')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $datatrail) {
            $browser->loginAs($admin)
                ->visit(route('admin.datatrails.index'))
                ->click('tr[data-entry-id="' . $datatrail->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='trail']", $datatrail->trail->title)
                ->assertSeeIn("td[field-key='user']", $datatrail->user->name)
                ->assertNotChecked("view")
                ->assertSeeIn("td[field-key='progress']", $datatrail->progress)
                ->assertSeeIn("td[field-key='rating']", $datatrail->rating)
                ->logout();
        });
    }

}
