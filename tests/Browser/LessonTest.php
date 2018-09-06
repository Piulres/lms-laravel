<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LessonTest extends DuskTestCase
{

    public function testCreateLesson()
    {
        $admin = \App\User::find(1);
        $lesson = factory('App\Lesson')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $lesson) {
            $browser->loginAs($admin)
                ->visit(route('admin.lessons.index'))
                ->clickLink('Add new')
                ->type("title", $lesson->title)
                ->type("introduction", $lesson->introduction)
                ->type("content", $lesson->content)
                ->press('Save')
                ->assertRouteIs('admin.lessons.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $lesson->title)
                ->assertSeeIn("tr:last-child td[field-key='introduction']", $lesson->introduction)
                ->assertSeeIn("tr:last-child td[field-key='content']", $lesson->content)
                ->logout();
        });
    }

    public function testEditLesson()
    {
        $admin = \App\User::find(1);
        $lesson = factory('App\Lesson')->create();
        $lesson2 = factory('App\Lesson')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $lesson, $lesson2) {
            $browser->loginAs($admin)
                ->visit(route('admin.lessons.index'))
                ->click('tr[data-entry-id="' . $lesson->id . '"] .btn-info')
                ->type("title", $lesson2->title)
                ->type("introduction", $lesson2->introduction)
                ->type("content", $lesson2->content)
                ->press('Update')
                ->assertRouteIs('admin.lessons.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $lesson2->title)
                ->assertSeeIn("tr:last-child td[field-key='introduction']", $lesson2->introduction)
                ->assertSeeIn("tr:last-child td[field-key='content']", $lesson2->content)
                ->logout();
        });
    }

    public function testShowLesson()
    {
        $admin = \App\User::find(1);
        $lesson = factory('App\Lesson')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $lesson) {
            $browser->loginAs($admin)
                ->visit(route('admin.lessons.index'))
                ->click('tr[data-entry-id="' . $lesson->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $lesson->title)
                ->assertSeeIn("td[field-key='introduction']", $lesson->introduction)
                ->assertSeeIn("td[field-key='content']", $lesson->content)
                ->logout();
        });
    }

}
