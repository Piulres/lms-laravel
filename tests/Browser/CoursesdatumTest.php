<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CoursesdatumTest extends DuskTestCase
{

    public function testCreateCoursesdatum()
    {
        $admin = \App\User::find(1);
        $coursesdata = factory('App\Coursesdatum')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $coursesdata) {
            $browser->loginAs($admin)
                ->visit(route('admin.coursesdatas.index'))
                ->clickLink('Add new')
                ->type("view", $coursesdata->view)
                ->type("progress", $coursesdata->progress)
                ->type("rating", $coursesdata->rating)
                ->type("testimonal", $coursesdata->testimonal)
                ->select("user_id", $coursesdata->user_id)
                ->select("course_id", $coursesdata->course_id)
                ->select("certificate_id", $coursesdata->certificate_id)
                ->press('Save')
                ->assertRouteIs('admin.coursesdatas.index')
                ->assertSeeIn("tr:last-child td[field-key='view']", $coursesdata->view)
                ->assertSeeIn("tr:last-child td[field-key='progress']", $coursesdata->progress)
                ->assertSeeIn("tr:last-child td[field-key='rating']", $coursesdata->rating)
                ->assertSeeIn("tr:last-child td[field-key='testimonal']", $coursesdata->testimonal)
                ->assertSeeIn("tr:last-child td[field-key='user']", $coursesdata->user->name)
                ->assertSeeIn("tr:last-child td[field-key='course']", $coursesdata->course->title)
                ->assertSeeIn("tr:last-child td[field-key='certificate']", $coursesdata->certificate->title)
                ->logout();
        });
    }

    public function testEditCoursesdatum()
    {
        $admin = \App\User::find(1);
        $coursesdata = factory('App\Coursesdatum')->create();
        $coursesdata2 = factory('App\Coursesdatum')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $coursesdata, $coursesdata2) {
            $browser->loginAs($admin)
                ->visit(route('admin.coursesdatas.index'))
                ->click('tr[data-entry-id="' . $coursesdata->id . '"] .btn-info')
                ->type("view", $coursesdata2->view)
                ->type("progress", $coursesdata2->progress)
                ->type("rating", $coursesdata2->rating)
                ->type("testimonal", $coursesdata2->testimonal)
                ->select("user_id", $coursesdata2->user_id)
                ->select("course_id", $coursesdata2->course_id)
                ->select("certificate_id", $coursesdata2->certificate_id)
                ->press('Update')
                ->assertRouteIs('admin.coursesdatas.index')
                ->assertSeeIn("tr:last-child td[field-key='view']", $coursesdata2->view)
                ->assertSeeIn("tr:last-child td[field-key='progress']", $coursesdata2->progress)
                ->assertSeeIn("tr:last-child td[field-key='rating']", $coursesdata2->rating)
                ->assertSeeIn("tr:last-child td[field-key='testimonal']", $coursesdata2->testimonal)
                ->assertSeeIn("tr:last-child td[field-key='user']", $coursesdata2->user->name)
                ->assertSeeIn("tr:last-child td[field-key='course']", $coursesdata2->course->title)
                ->assertSeeIn("tr:last-child td[field-key='certificate']", $coursesdata2->certificate->title)
                ->logout();
        });
    }

    public function testShowCoursesdatum()
    {
        $admin = \App\User::find(1);
        $coursesdata = factory('App\Coursesdatum')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $coursesdata) {
            $browser->loginAs($admin)
                ->visit(route('admin.coursesdatas.index'))
                ->click('tr[data-entry-id="' . $coursesdata->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='view']", $coursesdata->view)
                ->assertSeeIn("td[field-key='progress']", $coursesdata->progress)
                ->assertSeeIn("td[field-key='rating']", $coursesdata->rating)
                ->assertSeeIn("td[field-key='testimonal']", $coursesdata->testimonal)
                ->assertSeeIn("td[field-key='user']", $coursesdata->user->name)
                ->assertSeeIn("td[field-key='course']", $coursesdata->course->title)
                ->assertSeeIn("td[field-key='certificate']", $coursesdata->certificate->title)
                ->logout();
        });
    }

}
