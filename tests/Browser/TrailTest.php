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
            factory('App\Trailscategory')->create(), 
            factory('App\Trailscategory')->create(), 
            factory('App\Course')->create(), 
            factory('App\Course')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $trail, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.trails.index'))
                ->clickLink('Add new')
                ->type("title", $trail->title)
                ->select('select[name="categories[]"]', $relations[0]->id)
                ->select('select[name="categories[]"]', $relations[1]->id)
                ->select('select[name="courses[]"]', $relations[2]->id)
                ->select('select[name="courses[]"]', $relations[3]->id)
                ->press('Save')
                ->assertRouteIs('admin.trails.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $trail->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='courses'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='courses'] span:last-child", $relations[3]->title)
                ->logout();
        });
    }

    public function testEditTrail()
    {
        $admin = \App\User::find(1);
        $trail = factory('App\Trail')->create();
        $trail2 = factory('App\Trail')->make();

        $relations = [
            factory('App\Trailscategory')->create(), 
            factory('App\Trailscategory')->create(), 
            factory('App\Course')->create(), 
            factory('App\Course')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $trail, $trail2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.trails.index'))
                ->click('tr[data-entry-id="' . $trail->id . '"] .btn-info')
                ->type("title", $trail2->title)
                ->select('select[name="categories[]"]', $relations[0]->id)
                ->select('select[name="categories[]"]', $relations[1]->id)
                ->select('select[name="courses[]"]', $relations[2]->id)
                ->select('select[name="courses[]"]', $relations[3]->id)
                ->press('Update')
                ->assertRouteIs('admin.trails.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $trail2->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='courses'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='courses'] span:last-child", $relations[3]->title)
                ->logout();
        });
    }

    public function testShowTrail()
    {
        $admin = \App\User::find(1);
        $trail = factory('App\Trail')->create();

        $relations = [
            factory('App\Trailscategory')->create(), 
            factory('App\Trailscategory')->create(), 
            factory('App\Course')->create(), 
            factory('App\Course')->create(), 
        ];

        $trail->categories()->attach([$relations[0]->id, $relations[1]->id]);
        $trail->courses()->attach([$relations[2]->id, $relations[3]->id]);

        $this->browse(function (Browser $browser) use ($admin, $trail, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.trails.index'))
                ->click('tr[data-entry-id="' . $trail->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $trail->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='categories'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='courses'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='courses'] span:last-child", $relations[3]->title)
                ->logout();
        });
    }

}
