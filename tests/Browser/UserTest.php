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
                ->type("last_name", $user->last_name)
                ->type("email", $user->email)
                ->type("website", $user->website)
                ->attach("avatar", base_path("tests/_resources/test.jpg"))
                ->type("password", $user->password)
                ->select('select[name="role[]"]', $relations[0]->id)
                ->select('select[name="role[]"]', $relations[1]->id)
                ->select("team_id", $user->team_id)
                ->check("approved")
                ->press('Save')
                ->assertRouteIs('admin.users.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $user->name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $user->last_name)
                ->assertSeeIn("tr:last-child td[field-key='email']", $user->email)
                ->assertSeeIn("tr:last-child td[field-key='website']", $user->website)
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
                ->type("last_name", $user2->last_name)
                ->type("email", $user2->email)
                ->type("website", $user2->website)
                ->attach("avatar", base_path("tests/_resources/test.jpg"))
                ->type("password", $user2->password)
                ->select('select[name="role[]"]', $relations[0]->id)
                ->select('select[name="role[]"]', $relations[1]->id)
                ->select("team_id", $user2->team_id)
                ->check("approved")
                ->press('Update')
                ->assertRouteIs('admin.users.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $user2->name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $user2->last_name)
                ->assertSeeIn("tr:last-child td[field-key='email']", $user2->email)
                ->assertSeeIn("tr:last-child td[field-key='website']", $user2->website)
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
                ->assertSeeIn("td[field-key='last_name']", $user->last_name)
                ->assertSeeIn("td[field-key='email']", $user->email)
                ->assertSeeIn("td[field-key='website']", $user->website)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='role'] span:last-child", $relations[1]->title)
                ->assertSeeIn("td[field-key='team']", $user->team->name)
                ->assertNotChecked("approved")
                ->logout();
        });
    }

}
