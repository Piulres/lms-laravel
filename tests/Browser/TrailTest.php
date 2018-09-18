<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TrailTest extends DuskTestCase
{

    public function testCreateTrail()
    {
        $admin = \App\User::find(1);
        $trail = factory('App\Trail')->make();

        $relations = [
            factory('App\Course')->create(), 
            factory('App\Course')->create(), 
            factory('App\Trailcategory')->create(), 
            factory('App\Trailcategory')->create(), 
            factory('App\Trailtag')->create(), 
            factory('App\Trailtag')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $trail, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.trails.index'))
                ->clickLink('Add new')
                ->type("order", $trail->order)
                ->type("title", $trail->title)
                ->type("slug", $trail->slug)
                ->type("description", $trail->description)
                ->type("introduction", $trail->introduction)
                ->type("featured_image", $trail->featured_image)
                ->select('select[name="courses[]"]', $relations[0]->id)
                ->select('select[name="courses[]"]', $relations[1]->id)
                ->type("start_date", $trail->start_date)
                ->type("end_date", $trail->end_date)
                ->select('select[name="categories[]"]', $relations[2]->id)
                ->select('select[name="categories[]"]', $relations[3]->id)
                ->select('select[name="tags[]"]', $relations[4]->id)
                ->select('select[name="tags[]"]', $relations[5]->id)
                ->check("approved")
                ->press('Save')
                ->assertRouteIs('admin.trails.index')
                ->assertSeeIn("tr:last-child td[field-key='order']", $trail->order)
                ->assertSeeIn("tr:last-child td[field-key='title']", $trail->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $trail->slug)
                ->assertSeeIn("tr:last-child td[field-key='description']", $trail->description)
                ->assertSeeIn("tr:last-child td[field-key='introduction']", $trail->introduction)
                ->assertSeeIn("tr:last-child td[field-key='featured_image']", $trail->featured_image)
                ->assertSeeIn("tr:last-child td[field-key='courses'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='courses'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='start_date']", $trail->start_date)
                ->assertSeeIn("tr:last-child td[field-key='end_date']", $trail->end_date)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:last-child", $relations[3]->title)
                ->assertSeeIn("tr:last-child td[field-key='tags'] span:first-child", $relations[4]->title)
                ->assertSeeIn("tr:last-child td[field-key='tags'] span:last-child", $relations[5]->title)
                ->assertChecked("approved")
                ->logout();
        });
    }

    public function testEditTrail()
    {
        $admin = \App\User::find(1);
        $trail = factory('App\Trail')->create();
        $trail2 = factory('App\Trail')->make();

        $relations = [
            factory('App\Course')->create(), 
            factory('App\Course')->create(), 
            factory('App\Trailcategory')->create(), 
            factory('App\Trailcategory')->create(), 
            factory('App\Trailtag')->create(), 
            factory('App\Trailtag')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $trail, $trail2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.trails.index'))
                ->click('tr[data-entry-id="' . $trail->id . '"] .btn-info')
                ->type("order", $trail2->order)
                ->type("title", $trail2->title)
                ->type("slug", $trail2->slug)
                ->type("description", $trail2->description)
                ->type("introduction", $trail2->introduction)
                ->type("featured_image", $trail2->featured_image)
                ->select('select[name="courses[]"]', $relations[0]->id)
                ->select('select[name="courses[]"]', $relations[1]->id)
                ->type("start_date", $trail2->start_date)
                ->type("end_date", $trail2->end_date)
                ->select('select[name="categories[]"]', $relations[2]->id)
                ->select('select[name="categories[]"]', $relations[3]->id)
                ->select('select[name="tags[]"]', $relations[4]->id)
                ->select('select[name="tags[]"]', $relations[5]->id)
                ->check("approved")
                ->press('Update')
                ->assertRouteIs('admin.trails.index')
                ->assertSeeIn("tr:last-child td[field-key='order']", $trail2->order)
                ->assertSeeIn("tr:last-child td[field-key='title']", $trail2->title)
                ->assertSeeIn("tr:last-child td[field-key='slug']", $trail2->slug)
                ->assertSeeIn("tr:last-child td[field-key='description']", $trail2->description)
                ->assertSeeIn("tr:last-child td[field-key='introduction']", $trail2->introduction)
                ->assertSeeIn("tr:last-child td[field-key='featured_image']", $trail2->featured_image)
                ->assertSeeIn("tr:last-child td[field-key='courses'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='courses'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='start_date']", $trail2->start_date)
                ->assertSeeIn("tr:last-child td[field-key='end_date']", $trail2->end_date)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:last-child", $relations[3]->title)
                ->assertSeeIn("tr:last-child td[field-key='tags'] span:first-child", $relations[4]->title)
                ->assertSeeIn("tr:last-child td[field-key='tags'] span:last-child", $relations[5]->title)
                ->assertChecked("approved")
                ->logout();
        });
    }

    public function testShowTrail()
    {
        $admin = \App\User::find(1);
        $trail = factory('App\Trail')->create();

        $relations = [
            factory('App\Course')->create(), 
            factory('App\Course')->create(), 
            factory('App\Trailcategory')->create(), 
            factory('App\Trailcategory')->create(), 
            factory('App\Trailtag')->create(), 
            factory('App\Trailtag')->create(), 
        ];

        $trail->courses()->attach([$relations[0]->id, $relations[1]->id]);
        $trail->categories()->attach([$relations[2]->id, $relations[3]->id]);
        $trail->tags()->attach([$relations[4]->id, $relations[5]->id]);

        $this->browse(function (Browser $browser) use ($admin, $trail, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.trails.index'))
                ->click('tr[data-entry-id="' . $trail->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='order']", $trail->order)
                ->assertSeeIn("td[field-key='title']", $trail->title)
                ->assertSeeIn("td[field-key='slug']", $trail->slug)
                ->assertSeeIn("td[field-key='description']", $trail->description)
                ->assertSeeIn("td[field-key='introduction']", $trail->introduction)
                ->assertSeeIn("td[field-key='featured_image']", $trail->featured_image)
                ->assertSeeIn("tr:last-child td[field-key='courses'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='courses'] span:last-child", $relations[1]->title)
                ->assertSeeIn("td[field-key='start_date']", $trail->start_date)
                ->assertSeeIn("td[field-key='end_date']", $trail->end_date)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:last-child", $relations[3]->title)
                ->assertSeeIn("tr:last-child td[field-key='tags'] span:first-child", $relations[4]->title)
                ->assertSeeIn("tr:last-child td[field-key='tags'] span:last-child", $relations[5]->title)
                ->assertNotChecked("approved")
                ->logout();
        });
    }

}
