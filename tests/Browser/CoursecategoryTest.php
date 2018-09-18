<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CoursecategoryTest extends DuskTestCase
{

    public function testCreateCoursecategory()
    {
        $admin = \App\User::find(1);
        $coursecategory = factory('App\Coursecategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $coursecategory) {
            $browser->loginAs($admin)
                ->visit(route('admin.coursecategories.index'))
                ->clickLink('Add new')
                ->type("title", $coursecategory->title)
                ->type("slug", $coursecategory->slug)
                ->press('Save')
                ->assertRouteIs('admin.coursecategories.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $coursecategory->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $coursecategory->slug)
                ->logout();
        });
    }

    public function testEditCoursecategory()
    {
        $admin = \App\User::find(1);
        $coursecategory = factory('App\Coursecategory')->create();
        $coursecategory2 = factory('App\Coursecategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $coursecategory, $coursecategory2) {
            $browser->loginAs($admin)
                ->visit(route('admin.coursecategories.index'))
                ->click('tr[data-entry-id="' . $coursecategory->id . '"] .btn-info')
                ->type("title", $coursecategory2->title)
                ->type("slug", $coursecategory2->slug)
                ->press('Update')
                ->assertRouteIs('admin.coursecategories.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $coursecategory2->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $coursecategory2->slug)
                ->logout();
        });
    }

    public function testShowCoursecategory()
    {
        $admin = \App\User::find(1);
        $coursecategory = factory('App\Coursecategory')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $coursecategory) {
            $browser->loginAs($admin)
                ->visit(route('admin.coursecategories.index'))
                ->click('tr[data-entry-id="' . $coursecategory->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $coursecategory->title)
                ->assertSeeIn("td[field-key='slug']", $coursecategory->slug)
                ->logout();
        });
    }

}
