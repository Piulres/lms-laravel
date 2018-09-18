<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CoursetagTest extends DuskTestCase
{

    public function testCreateCoursetag()
    {
        $admin = \App\User::find(1);
        $coursetag = factory('App\Coursetag')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $coursetag) {
            $browser->loginAs($admin)
                ->visit(route('admin.coursetags.index'))
                ->clickLink('Add new')
                ->type("title", $coursetag->title)
                ->type("slug", $coursetag->slug)
                ->press('Save')
                ->assertRouteIs('admin.coursetags.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $coursetag->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $coursetag->slug)
                ->logout();
        });
    }

    public function testEditCoursetag()
    {
        $admin = \App\User::find(1);
        $coursetag = factory('App\Coursetag')->create();
        $coursetag2 = factory('App\Coursetag')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $coursetag, $coursetag2) {
            $browser->loginAs($admin)
                ->visit(route('admin.coursetags.index'))
                ->click('tr[data-entry-id="' . $coursetag->id . '"] .btn-info')
                ->type("title", $coursetag2->title)
                ->type("slug", $coursetag2->slug)
                ->press('Update')
                ->assertRouteIs('admin.coursetags.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $coursetag2->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $coursetag2->slug)
                ->logout();
        });
    }

    public function testShowCoursetag()
    {
        $admin = \App\User::find(1);
        $coursetag = factory('App\Coursetag')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $coursetag) {
            $browser->loginAs($admin)
                ->visit(route('admin.coursetags.index'))
                ->click('tr[data-entry-id="' . $coursetag->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $coursetag->title)
                ->assertSeeIn("td[field-key='slug']", $coursetag->slug)
                ->logout();
        });
    }

}
