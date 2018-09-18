<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TraildatumTest extends DuskTestCase
{

    public function testCreateTraildatum()
    {
        $admin = \App\User::find(1);
        $traildata = factory('App\Traildatum')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $traildata) {
            $browser->loginAs($admin)
                ->visit(route('admin.traildatas.index'))
                ->clickLink('Add new')
                ->type("view", $traildata->view)
                ->type("progress", $traildata->progress)
                ->type("rating", $traildata->rating)
                ->type("testimonal", $traildata->testimonal)
                ->select("user_id", $traildata->user_id)
                ->select("trail_id", $traildata->trail_id)
                ->select("certificate_id", $traildata->certificate_id)
                ->press('Save')
                ->assertRouteIs('admin.traildatas.index')
                ->assertSeeIn("tr:last-child td[field-key='view']", $traildata->view)
                ->assertSeeIn("tr:last-child td[field-key='progress']", $traildata->progress)
                ->assertSeeIn("tr:last-child td[field-key='rating']", $traildata->rating)
                ->assertSeeIn("tr:last-child td[field-key='testimonal']", $traildata->testimonal)
                ->assertSeeIn("tr:last-child td[field-key='user']", $traildata->user->name)
                ->assertSeeIn("tr:last-child td[field-key='trail']", $traildata->trail->title)
                ->assertSeeIn("tr:last-child td[field-key='certificate']", $traildata->certificate->title)
                ->logout();
        });
    }

    public function testEditTraildatum()
    {
        $admin = \App\User::find(1);
        $traildata = factory('App\Traildatum')->create();
        $traildata2 = factory('App\Traildatum')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $traildata, $traildata2) {
            $browser->loginAs($admin)
                ->visit(route('admin.traildatas.index'))
                ->click('tr[data-entry-id="' . $traildata->id . '"] .btn-info')
                ->type("view", $traildata2->view)
                ->type("progress", $traildata2->progress)
                ->type("rating", $traildata2->rating)
                ->type("testimonal", $traildata2->testimonal)
                ->select("user_id", $traildata2->user_id)
                ->select("trail_id", $traildata2->trail_id)
                ->select("certificate_id", $traildata2->certificate_id)
                ->press('Update')
                ->assertRouteIs('admin.traildatas.index')
                ->assertSeeIn("tr:last-child td[field-key='view']", $traildata2->view)
                ->assertSeeIn("tr:last-child td[field-key='progress']", $traildata2->progress)
                ->assertSeeIn("tr:last-child td[field-key='rating']", $traildata2->rating)
                ->assertSeeIn("tr:last-child td[field-key='testimonal']", $traildata2->testimonal)
                ->assertSeeIn("tr:last-child td[field-key='user']", $traildata2->user->name)
                ->assertSeeIn("tr:last-child td[field-key='trail']", $traildata2->trail->title)
                ->assertSeeIn("tr:last-child td[field-key='certificate']", $traildata2->certificate->title)
                ->logout();
        });
    }

    public function testShowTraildatum()
    {
        $admin = \App\User::find(1);
        $traildata = factory('App\Traildatum')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $traildata) {
            $browser->loginAs($admin)
                ->visit(route('admin.traildatas.index'))
                ->click('tr[data-entry-id="' . $traildata->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='view']", $traildata->view)
                ->assertSeeIn("td[field-key='progress']", $traildata->progress)
                ->assertSeeIn("td[field-key='rating']", $traildata->rating)
                ->assertSeeIn("td[field-key='testimonal']", $traildata->testimonal)
                ->assertSeeIn("td[field-key='user']", $traildata->user->name)
                ->assertSeeIn("td[field-key='trail']", $traildata->trail->title)
                ->assertSeeIn("td[field-key='certificate']", $traildata->certificate->title)
                ->logout();
        });
    }

}
