<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CourseTest extends DuskTestCase
{

    public function testCreateCourse()
    {
        $admin = \App\User::find(1);
        $course = factory('App\Course')->make();

        $relations = [
            factory('App\User')->create(), 
            factory('App\User')->create(), 
            factory('App\Lesson')->create(), 
            factory('App\Lesson')->create(), 
            factory('App\Coursescategory')->create(), 
            factory('App\Coursescategory')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $course, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.courses.index'))
                ->clickLink('Add new')
                ->type("title", $course->title)
                ->select('select[name="instructor[]"]', $relations[0]->id)
                ->select('select[name="instructor[]"]', $relations[1]->id)
                ->select('select[name="lessons[]"]', $relations[2]->id)
                ->select('select[name="lessons[]"]', $relations[3]->id)
                ->select('select[name="categories[]"]', $relations[4]->id)
                ->select('select[name="categories[]"]', $relations[5]->id)
                ->attach("featured_image", base_path("tests/_resources/test.jpg"))
                ->type("description", $course->description)
                ->type("introduction", $course->introduction)
                ->type("duration", $course->duration)
                ->press('Save')
                ->assertRouteIs('admin.courses.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $course->title)
                ->assertSeeIn("tr:last-child td[field-key='instructor'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='instructor'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='lessons'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='lessons'] span:last-child", $relations[3]->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:first-child", $relations[4]->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:last-child", $relations[5]->title)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Course::first()->featured_image . "']")
                ->assertSeeIn("tr:last-child td[field-key='description']", $course->description)
                ->assertSeeIn("tr:last-child td[field-key='introduction']", $course->introduction)
                ->assertSeeIn("tr:last-child td[field-key='duration']", $course->duration)
                ->logout();
        });
    }

    public function testEditCourse()
    {
        $admin = \App\User::find(1);
        $course = factory('App\Course')->create();
        $course2 = factory('App\Course')->make();

        $relations = [
            factory('App\User')->create(), 
            factory('App\User')->create(), 
            factory('App\Lesson')->create(), 
            factory('App\Lesson')->create(), 
            factory('App\Coursescategory')->create(), 
            factory('App\Coursescategory')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $course, $course2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.courses.index'))
                ->click('tr[data-entry-id="' . $course->id . '"] .btn-info')
                ->type("title", $course2->title)
                ->select('select[name="instructor[]"]', $relations[0]->id)
                ->select('select[name="instructor[]"]', $relations[1]->id)
                ->select('select[name="lessons[]"]', $relations[2]->id)
                ->select('select[name="lessons[]"]', $relations[3]->id)
                ->select('select[name="categories[]"]', $relations[4]->id)
                ->select('select[name="categories[]"]', $relations[5]->id)
                ->attach("featured_image", base_path("tests/_resources/test.jpg"))
                ->type("description", $course2->description)
                ->type("introduction", $course2->introduction)
                ->type("duration", $course2->duration)
                ->press('Update')
                ->assertRouteIs('admin.courses.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $course2->title)
                ->assertSeeIn("tr:last-child td[field-key='instructor'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='instructor'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='lessons'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='lessons'] span:last-child", $relations[3]->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:first-child", $relations[4]->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:last-child", $relations[5]->title)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Course::first()->featured_image . "']")
                ->assertSeeIn("tr:last-child td[field-key='description']", $course2->description)
                ->assertSeeIn("tr:last-child td[field-key='introduction']", $course2->introduction)
                ->assertSeeIn("tr:last-child td[field-key='duration']", $course2->duration)
                ->logout();
        });
    }

    public function testShowCourse()
    {
        $admin = \App\User::find(1);
        $course = factory('App\Course')->create();

        $relations = [
            factory('App\User')->create(), 
            factory('App\User')->create(), 
            factory('App\Lesson')->create(), 
            factory('App\Lesson')->create(), 
            factory('App\Coursescategory')->create(), 
            factory('App\Coursescategory')->create(), 
        ];

        $course->instructor()->attach([$relations[0]->id, $relations[1]->id]);
        $course->lessons()->attach([$relations[2]->id, $relations[3]->id]);
        $course->categories()->attach([$relations[4]->id, $relations[5]->id]);

        $this->browse(function (Browser $browser) use ($admin, $course, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.courses.index'))
                ->click('tr[data-entry-id="' . $course->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $course->title)
                ->assertSeeIn("tr:last-child td[field-key='instructor'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='instructor'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='lessons'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='lessons'] span:last-child", $relations[3]->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:first-child", $relations[4]->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:last-child", $relations[5]->title)
                ->assertSeeIn("td[field-key='description']", $course->description)
                ->assertSeeIn("td[field-key='introduction']", $course->introduction)
                ->assertSeeIn("td[field-key='duration']", $course->duration)
                ->logout();
        });
    }

}
