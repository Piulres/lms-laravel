<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class UserTest extends DuskTestCase
{

    public function testCreateUser()
    {
        $admin = \App\User::find(1);
        $user = factory('App\User')->make();

        $relations = [
            factory('App\Role')->create(), 
            factory('App\Role')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $user, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.users.index'))
                ->clickLink('Add new')
                ->type("name", $user->name)
                ->type("lastname", $user->lastname)
                ->type("website", $user->website)
                ->type("email", $user->email)
                ->type("password", $user->password)
                ->attach("avatar", base_path("tests/_resources/test.jpg"))
                ->select('select[name="role[]"]', $relations[0]->id)
                ->select('select[name="role[]"]', $relations[1]->id)
                ->select("team_id", $user->team_id)
                ->check("approved")
                ->press('Save')
                ->assertRouteIs('admin.users.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $user->name)
                ->assertSeeIn("tr:last-child td[field-key='lastname']", $user->lastname)
                ->assertSeeIn("tr:last-child td[field-key='website']", $user->website)
                ->assertSeeIn("tr:last-child td[field-key='email']", $user->email)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\User::first()->avatar . "']")
                ->assertSeeIn("tr:last-child td[field-key='role'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='team']", $user->team->name)
                ->assertChecked("approved")
                ->logout();
        });
    }

    public function testEditUser()
    {
        $admin = \App\User::find(1);
        $user = factory('App\User')->create();
        $user2 = factory('App\User')->make();

        $relations = [
            factory('App\Role')->create(), 
            factory('App\Role')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $user, $user2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.users.index'))
                ->click('tr[data-entry-id="' . $user->id . '"] .btn-info')
                ->type("name", $user2->name)
                ->type("lastname", $user2->lastname)
                ->type("website", $user2->website)
                ->type("email", $user2->email)
                ->type("password", $user2->password)
                ->attach("avatar", base_path("tests/_resources/test.jpg"))
                ->select('select[name="role[]"]', $relations[0]->id)
                ->select('select[name="role[]"]', $relations[1]->id)
                ->select("team_id", $user2->team_id)
                ->check("approved")
                ->press('Update')
                ->assertRouteIs('admin.users.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $user2->name)
                ->assertSeeIn("tr:last-child td[field-key='lastname']", $user2->lastname)
                ->assertSeeIn("tr:last-child td[field-key='website']", $user2->website)
                ->assertSeeIn("tr:last-child td[field-key='email']", $user2->email)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\User::first()->avatar . "']")
                ->assertSeeIn("tr:last-child td[field-key='role'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='team']", $user2->team->name)
                ->assertChecked("approved")
                ->logout();
        });
    }

    public function testShowUser()
    {
        $admin = \App\User::find(1);
        $user = factory('App\User')->create();

        $relations = [
            factory('App\Role')->create(), 
            factory('App\Role')->create(), 
        ];

        $user->role()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $user, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.users.index'))
                ->click('tr[data-entry-id="' . $user->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $user->name)
                ->assertSeeIn("td[field-key='lastname']", $user->lastname)
                ->assertSeeIn("td[field-key='website']", $user->website)
                ->assertSeeIn("td[field-key='email']", $user->email)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:last-child", $relations[1]->title)
                ->assertSeeIn("td[field-key='team']", $user->team->name)
                ->assertNotChecked("approved")
                ->logout();
        });
    }

}
