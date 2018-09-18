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
                ->type("view", $datacourse->view)
                ->type("progress", $datacourse->progress)
                ->type("rating", $datacourse->rating)
                ->type("testimonal", $datacourse->testimonal)
                ->select("user_id", $datacourse->user_id)
                ->select("course_id", $datacourse->course_id)
                ->select("certificate_id", $datacourse->certificate_id)
                ->press('Save')
                ->assertRouteIs('admin.datacourses.index')
                ->assertSeeIn("tr:last-child td[field-key='view']", $datacourse->view)
                ->assertSeeIn("tr:last-child td[field-key='progress']", $datacourse->progress)
                ->assertSeeIn("tr:last-child td[field-key='rating']", $datacourse->rating)
                ->assertSeeIn("tr:last-child td[field-key='testimonal']", $datacourse->testimonal)
                ->assertSeeIn("tr:last-child td[field-key='user']", $datacourse->user->name)
                ->assertSeeIn("tr:last-child td[field-key='course']", $datacourse->course->title)
                ->assertSeeIn("tr:last-child td[field-key='certificate']", $datacourse->certificate->title)
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
                ->type("view", $datacourse2->view)
                ->type("progress", $datacourse2->progress)
                ->type("rating", $datacourse2->rating)
                ->type("testimonal", $datacourse2->testimonal)
                ->select("user_id", $datacourse2->user_id)
                ->select("course_id", $datacourse2->course_id)
                ->select("certificate_id", $datacourse2->certificate_id)
                ->press('Update')
                ->assertRouteIs('admin.datacourses.index')
                ->assertSeeIn("tr:last-child td[field-key='view']", $datacourse2->view)
                ->assertSeeIn("tr:last-child td[field-key='progress']", $datacourse2->progress)
                ->assertSeeIn("tr:last-child td[field-key='rating']", $datacourse2->rating)
                ->assertSeeIn("tr:last-child td[field-key='testimonal']", $datacourse2->testimonal)
                ->assertSeeIn("tr:last-child td[field-key='user']", $datacourse2->user->name)
                ->assertSeeIn("tr:last-child td[field-key='course']", $datacourse2->course->title)
                ->assertSeeIn("tr:last-child td[field-key='certificate']", $datacourse2->certificate->title)
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
                ->assertSeeIn("td[field-key='view']", $datacourse->view)
                ->assertSeeIn("td[field-key='progress']", $datacourse->progress)
                ->assertSeeIn("td[field-key='rating']", $datacourse->rating)
                ->assertSeeIn("td[field-key='testimonal']", $datacourse->testimonal)
                ->assertSeeIn("td[field-key='user']", $datacourse->user->name)
                ->assertSeeIn("td[field-key='course']", $datacourse->course->title)
                ->assertSeeIn("td[field-key='certificate']", $datacourse->certificate->title)
                ->logout();
        });
    }

}
