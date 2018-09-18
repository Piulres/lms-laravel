<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CoursescertificateTest extends DuskTestCase
{

    public function testCreateCoursescertificate()
    {
        $admin = \App\User::find(1);
        $coursescertificate = factory('App\Coursescertificate')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $coursescertificate) {
            $browser->loginAs($admin)
                ->visit(route('admin.coursescertificates.index'))
                ->clickLink('Add new')
                ->type("order", $coursescertificate->order)
                ->type("title", $coursescertificate->title)
                ->type("slug", $coursescertificate->slug)
                ->attach("image", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.coursescertificates.index')
                ->assertSeeIn("tr:last-child td[field-key='order']", $coursescertificate->order)
                ->assertSeeIn("tr:last-child td[field-key='title']", $coursescertificate->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $coursescertificate->slug)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Coursescertificate::first()->image . "']")
                ->logout();
        });
    }

    public function testEditCoursescertificate()
    {
        $admin = \App\User::find(1);
        $coursescertificate = factory('App\Coursescertificate')->create();
        $coursescertificate2 = factory('App\Coursescertificate')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $coursescertificate, $coursescertificate2) {
            $browser->loginAs($admin)
                ->visit(route('admin.coursescertificates.index'))
                ->click('tr[data-entry-id="' . $coursescertificate->id . '"] .btn-info')
                ->type("order", $coursescertificate2->order)
                ->type("title", $coursescertificate2->title)
                ->type("slug", $coursescertificate2->slug)
                ->attach("image", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.coursescertificates.index')
                ->assertSeeIn("tr:last-child td[field-key='order']", $coursescertificate2->order)
                ->assertSeeIn("tr:last-child td[field-key='title']", $coursescertificate2->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $coursescertificate2->slug)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Coursescertificate::first()->image . "']")
                ->logout();
        });
    }

    public function testShowCoursescertificate()
    {
        $admin = \App\User::find(1);
        $coursescertificate = factory('App\Coursescertificate')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $coursescertificate) {
            $browser->loginAs($admin)
                ->visit(route('admin.coursescertificates.index'))
                ->click('tr[data-entry-id="' . $coursescertificate->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='order']", $coursescertificate->order)
                ->assertSeeIn("td[field-key='title']", $coursescertificate->title)
                ->assertSeeIn("td[field-key='slug']", $coursescertificate->slug)
                ->logout();
        });
    }

}
