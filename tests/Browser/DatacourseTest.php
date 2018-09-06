<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DatacourseTest extends DuskTestCase
{

    public function testCreateDatacourse()
    {
        $admin = \App\User::find(1);
        $datacourse = factory('App\Datacourse')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $datacourse) {
            $browser->loginAs($admin)
                ->visit(route('admin.datacourses.index'))
                ->clickLink('Add new')
                ->select("course_id", $datacourse->course_id)
                ->select("user_id", $datacourse->user_id)
                ->check("view")
                ->type("progress", $datacourse->progress)
                ->type("rating", $datacourse->rating)
                ->press('Save')
                ->assertRouteIs('admin.datacourses.index')
                ->assertSeeIn("tr:last-child td[field-key='course']", $datacourse->course->title)
                ->assertSeeIn("tr:last-child td[field-key='user']", $datacourse->user->name)
                ->assertChecked("view")
                ->assertSeeIn("tr:last-child td[field-key='progress']", $datacourse->progress)
                ->assertSeeIn("tr:last-child td[field-key='rating']", $datacourse->rating)
                ->logout();
        });
    }

    public function testEditDatacourse()
    {
        $admin = \App\User::find(1);
        $datacourse = factory('App\Datacourse')->create();
        $datacourse2 = factory('App\Datacourse')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $datacourse, $datacourse2) {
            $browser->loginAs($admin)
                ->visit(route('admin.datacourses.index'))
                ->click('tr[data-entry-id="' . $datacourse->id . '"] .btn-info')
                ->select("course_id", $datacourse2->course_id)
                ->select("user_id", $datacourse2->user_id)
                ->check("view")
                ->type("progress", $datacourse2->progress)
                ->type("rating", $datacourse2->rating)
                ->press('Update')
                ->assertRouteIs('admin.datacourses.index')
                ->assertSeeIn("tr:last-child td[field-key='course']", $datacourse2->course->title)
                ->assertSeeIn("tr:last-child td[field-key='user']", $datacourse2->user->name)
                ->assertChecked("view")
                ->assertSeeIn("tr:last-child td[field-key='progress']", $datacourse2->progress)
                ->assertSeeIn("tr:last-child td[field-key='rating']", $datacourse2->rating)
                ->logout();
        });
    }

    public function testShowDatacourse()
    {
        $admin = \App\User::find(1);
        $datacourse = factory('App\Datacourse')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $datacourse) {
            $browser->loginAs($admin)
                ->visit(route('admin.datacourses.index'))
                ->click('tr[data-entry-id="' . $datacourse->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='course']", $datacourse->course->title)
                ->assertSeeIn("td[field-key='user']", $datacourse->user->name)
                ->assertNotChecked("view")
                ->assertSeeIn("td[field-key='progress']", $datacourse->progress)
                ->assertSeeIn("td[field-key='rating']", $datacourse->rating)
                ->logout();
        });
    }

}
