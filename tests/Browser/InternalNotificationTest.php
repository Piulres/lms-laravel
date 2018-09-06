<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class InternalNotificationTest extends DuskTestCase
{

    public function testCreateInternalNotification()
    {
        $admin = \App\User::find(1);
        $internal_notification = factory('App\InternalNotification')->make();

        $relations = [
            factory('App\User')->create(), 
            factory('App\User')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $internal_notification, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.internal_notifications.index'))
                ->clickLink('Add new')
                ->type("text", $internal_notification->text)
                ->type("link", $internal_notification->link)
                ->select('select[name="users[]"]', $relations[0]->id)
                ->select('select[name="users[]"]', $relations[1]->id)
                ->press('Save')
                ->assertRouteIs('admin.internal_notifications.index')
                ->assertSeeIn("tr:last-child td[field-key='text']", $internal_notification->text)
                ->assertSeeIn("tr:last-child td[field-key='link']", $internal_notification->link)
                ->assertSeeIn("tr:last-child td[field-key='users'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='users'] span:last-child", $relations[1]->name)
                ->logout();
        });
    }

    public function testEditInternalNotification()
    {
        $admin = \App\User::find(1);
        $internal_notification = factory('App\InternalNotification')->create();
        $internal_notification2 = factory('App\InternalNotification')->make();

        $relations = [
            factory('App\User')->create(), 
            factory('App\User')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $internal_notification, $internal_notification2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.internal_notifications.index'))
                ->click('tr[data-entry-id="' . $internal_notification->id . '"] .btn-info')
                ->type("text", $internal_notification2->text)
                ->type("link", $internal_notification2->link)
                ->select('select[name="users[]"]', $relations[0]->id)
                ->select('select[name="users[]"]', $relations[1]->id)
                ->press('Update')
                ->assertRouteIs('admin.internal_notifications.index')
                ->assertSeeIn("tr:last-child td[field-key='text']", $internal_notification2->text)
                ->assertSeeIn("tr:last-child td[field-key='link']", $internal_notification2->link)
                ->assertSeeIn("tr:last-child td[field-key='users'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='users'] span:last-child", $relations[1]->name)
                ->logout();
        });
    }

    public function testShowInternalNotification()
    {
        $admin = \App\User::find(1);
        $internal_notification = factory('App\InternalNotification')->create();

        $relations = [
            factory('App\User')->create(), 
            factory('App\User')->create(), 
        ];

        $internal_notification->users()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $internal_notification, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.internal_notifications.index'))
                ->click('tr[data-entry-id="' . $internal_notification->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='text']", $internal_notification->text)
                ->assertSeeIn("td[field-key='link']", $internal_notification->link)
                ->assertSeeIn("tr:last-child td[field-key='users'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='users'] span:last-child", $relations[1]->name)
                ->logout();
        });
    }

}
