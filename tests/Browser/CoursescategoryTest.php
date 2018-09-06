<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CoursescategoryTest extends DuskTestCase
{

    public function testCreateCoursescategory()
    {
        $admin = \App\User::find(1);
        $coursescategory = factory('App\Coursescategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $coursescategory) {
            $browser->loginAs($admin)
                ->visit(route('admin.coursescategories.index'))
                ->clickLink('Add new')
                ->type("title", $coursescategory->title)
                ->press('Save')
                ->assertRouteIs('admin.coursescategories.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $coursescategory->title)
                ->logout();
        });
    }

    public function testEditCoursescategory()
    {
        $admin = \App\User::find(1);
        $coursescategory = factory('App\Coursescategory')->create();
        $coursescategory2 = factory('App\Coursescategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $coursescategory, $coursescategory2) {
            $browser->loginAs($admin)
                ->visit(route('admin.coursescategories.index'))
                ->click('tr[data-entry-id="' . $coursescategory->id . '"] .btn-info')
                ->type("title", $coursescategory2->title)
                ->press('Update')
                ->assertRouteIs('admin.coursescategories.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $coursescategory2->title)
                ->logout();
        });
    }

    public function testShowCoursescategory()
    {
        $admin = \App\User::find(1);
        $coursescategory = factory('App\Coursescategory')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $coursescategory) {
            $browser->loginAs($admin)
                ->visit(route('admin.coursescategories.index'))
                ->click('tr[data-entry-id="' . $coursescategory->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $coursescategory->title)
                ->logout();
        });
    }

}
