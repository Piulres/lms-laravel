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
                ->type("view", $datatrail->view)
                ->type("progress", $datatrail->progress)
                ->type("rating", $datatrail->rating)
                ->type("testimonal", $datatrail->testimonal)
                ->select("user_id", $datatrail->user_id)
                ->select("trail_id", $datatrail->trail_id)
                ->select("certificate_id", $datatrail->certificate_id)
                ->press('Save')
                ->assertRouteIs('admin.datatrails.index')
                ->assertSeeIn("tr:last-child td[field-key='view']", $datatrail->view)
                ->assertSeeIn("tr:last-child td[field-key='progress']", $datatrail->progress)
                ->assertSeeIn("tr:last-child td[field-key='rating']", $datatrail->rating)
                ->assertSeeIn("tr:last-child td[field-key='testimonal']", $datatrail->testimonal)
                ->assertSeeIn("tr:last-child td[field-key='user']", $datatrail->user->name)
                ->assertSeeIn("tr:last-child td[field-key='trail']", $datatrail->trail->title)
                ->assertSeeIn("tr:last-child td[field-key='certificate']", $datatrail->certificate->title)
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
                ->type("view", $datatrail2->view)
                ->type("progress", $datatrail2->progress)
                ->type("rating", $datatrail2->rating)
                ->type("testimonal", $datatrail2->testimonal)
                ->select("user_id", $datatrail2->user_id)
                ->select("trail_id", $datatrail2->trail_id)
                ->select("certificate_id", $datatrail2->certificate_id)
                ->press('Update')
                ->assertRouteIs('admin.datatrails.index')
                ->assertSeeIn("tr:last-child td[field-key='view']", $datatrail2->view)
                ->assertSeeIn("tr:last-child td[field-key='progress']", $datatrail2->progress)
                ->assertSeeIn("tr:last-child td[field-key='rating']", $datatrail2->rating)
                ->assertSeeIn("tr:last-child td[field-key='testimonal']", $datatrail2->testimonal)
                ->assertSeeIn("tr:last-child td[field-key='user']", $datatrail2->user->name)
                ->assertSeeIn("tr:last-child td[field-key='trail']", $datatrail2->trail->title)
                ->assertSeeIn("tr:last-child td[field-key='certificate']", $datatrail2->certificate->title)
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
                ->assertSeeIn("td[field-key='view']", $datatrail->view)
                ->assertSeeIn("td[field-key='progress']", $datatrail->progress)
                ->assertSeeIn("td[field-key='rating']", $datatrail->rating)
                ->assertSeeIn("td[field-key='testimonal']", $datatrail->testimonal)
                ->assertSeeIn("td[field-key='user']", $datatrail->user->name)
                ->assertSeeIn("td[field-key='trail']", $datatrail->trail->title)
                ->assertSeeIn("td[field-key='certificate']", $datatrail->certificate->title)
                ->logout();
        });
    }

}
