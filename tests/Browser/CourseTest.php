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
            factory('App\Coursecategory')->create(), 
            factory('App\Coursecategory')->create(), 
            factory('App\Coursetag')->create(), 
            factory('App\Coursetag')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $course, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.courses.index'))
                ->clickLink('Add new')
                ->type("order", $course->order)
                ->type("title", $course->title)
                ->type("slug", $course->slug)
                ->type("description", $course->description)
                ->type("introduction", $course->introduction)
                ->attach("featured_image", base_path("tests/_resources/test.jpg"))
                ->select('select[name="instructor[]"]', $relations[0]->id)
                ->select('select[name="instructor[]"]', $relations[1]->id)
                ->select('select[name="lessons[]"]', $relations[2]->id)
                ->select('select[name="lessons[]"]', $relations[3]->id)
                ->type("duration", $course->duration)
                ->type("start_date", $course->start_date)
                ->type("end_date", $course->end_date)
                ->select('select[name="categories[]"]', $relations[4]->id)
                ->select('select[name="categories[]"]', $relations[5]->id)
                ->select('select[name="tags[]"]', $relations[6]->id)
                ->select('select[name="tags[]"]', $relations[7]->id)
                ->check("approved")
                ->press('Save')
                ->assertRouteIs('admin.courses.index')
                ->assertSeeIn("tr:last-child td[field-key='order']", $course->order)
                ->assertSeeIn("tr:last-child td[field-key='title']", $course->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $course->slug)
                ->assertSeeIn("tr:last-child td[field-key='description']", $course->description)
                ->assertSeeIn("tr:last-child td[field-key='introduction']", $course->introduction)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Course::first()->featured_image . "']")
                ->assertSeeIn("tr:last-child td[field-key='instructor'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='instructor'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='lessons'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='lessons'] span:last-child", $relations[3]->title)
                ->assertSeeIn("tr:last-child td[field-key='duration']", $course->duration)
                ->assertSeeIn("tr:last-child td[field-key='start_date']", $course->start_date)
                ->assertSeeIn("tr:last-child td[field-key='end_date']", $course->end_date)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:first-child", $relations[4]->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:last-child", $relations[5]->title)
                ->assertSeeIn("tr:last-child td[field-key='tags'] span:first-child", $relations[6]->title)
                ->assertSeeIn("tr:last-child td[field-key='tags'] span:last-child", $relations[7]->title)
                ->assertChecked("approved")
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
            factory('App\Coursecategory')->create(), 
            factory('App\Coursecategory')->create(), 
            factory('App\Coursetag')->create(), 
            factory('App\Coursetag')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $course, $course2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.courses.index'))
                ->click('tr[data-entry-id="' . $course->id . '"] .btn-info')
                ->type("order", $course2->order)
                ->type("title", $course2->title)
                ->type("slug", $course2->slug)
                ->type("description", $course2->description)
                ->type("introduction", $course2->introduction)
                ->attach("featured_image", base_path("tests/_resources/test.jpg"))
                ->select('select[name="instructor[]"]', $relations[0]->id)
                ->select('select[name="instructor[]"]', $relations[1]->id)
                ->select('select[name="lessons[]"]', $relations[2]->id)
                ->select('select[name="lessons[]"]', $relations[3]->id)
                ->type("duration", $course2->duration)
                ->type("start_date", $course2->start_date)
                ->type("end_date", $course2->end_date)
                ->select('select[name="categories[]"]', $relations[4]->id)
                ->select('select[name="categories[]"]', $relations[5]->id)
                ->select('select[name="tags[]"]', $relations[6]->id)
                ->select('select[name="tags[]"]', $relations[7]->id)
                ->check("approved")
                ->press('Update')
                ->assertRouteIs('admin.courses.index')
                ->assertSeeIn("tr:last-child td[field-key='order']", $course2->order)
                ->assertSeeIn("tr:last-child td[field-key='title']", $course2->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $course2->slug)
                ->assertSeeIn("tr:last-child td[field-key='description']", $course2->description)
                ->assertSeeIn("tr:last-child td[field-key='introduction']", $course2->introduction)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Course::first()->featured_image . "']")
                ->assertSeeIn("tr:last-child td[field-key='instructor'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='instructor'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='lessons'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='lessons'] span:last-child", $relations[3]->title)
                ->assertSeeIn("tr:last-child td[field-key='duration']", $course2->duration)
                ->assertSeeIn("tr:last-child td[field-key='start_date']", $course2->start_date)
                ->assertSeeIn("tr:last-child td[field-key='end_date']", $course2->end_date)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:first-child", $relations[4]->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:last-child", $relations[5]->title)
                ->assertSeeIn("tr:last-child td[field-key='tags'] span:first-child", $relations[6]->title)
                ->assertSeeIn("tr:last-child td[field-key='tags'] span:last-child", $relations[7]->title)
                ->assertChecked("approved")
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
            factory('App\Coursecategory')->create(), 
            factory('App\Coursecategory')->create(), 
            factory('App\Coursetag')->create(), 
            factory('App\Coursetag')->create(), 
        ];

        $course->instructor()->attach([$relations[0]->id, $relations[1]->id]);
        $course->lessons()->attach([$relations[2]->id, $relations[3]->id]);
        $course->categories()->attach([$relations[4]->id, $relations[5]->id]);
        $course->tags()->attach([$relations[6]->id, $relations[7]->id]);

        $this->browse(function (Browser $browser) use ($admin, $course, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.courses.index'))
                ->click('tr[data-entry-id="' . $course->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='order']", $course->order)
                ->assertSeeIn("td[field-key='title']", $course->title)
                ->assertSeeIn("td[field-key='slug']", $course->slug)
                ->assertSeeIn("td[field-key='description']", $course->description)
                ->assertSeeIn("td[field-key='introduction']", $course->introduction)
                ->assertSeeIn("tr:last-child td[field-key='instructor'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='instructor'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='lessons'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='lessons'] span:last-child", $relations[3]->title)
                ->assertSeeIn("td[field-key='duration']", $course->duration)
                ->assertSeeIn("td[field-key='start_date']", $course->start_date)
                ->assertSeeIn("td[field-key='end_date']", $course->end_date)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:first-child", $relations[4]->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:last-child", $relations[5]->title)
                ->assertSeeIn("tr:last-child td[field-key='tags'] span:first-child", $relations[6]->title)
                ->assertSeeIn("tr:last-child td[field-key='tags'] span:last-child", $relations[7]->title)
                ->assertNotChecked("approved")
                ->logout();
        });
    }

}
