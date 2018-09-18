<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Hash;
use App\Traits\FilterByTeam;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $lastname
 * @property string $website
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property string $remember_token
 * @property string $team
 * @property tinyInteger $approved
*/
class User extends Authenticatable
{
    use Notifiable;
    use FilterByTeam;

    protected $fillable = ['name', 'lastname', 'website', 'email', 'password', 'avatar', 'remember_token', 'approved', 'team_id'];
    protected $hidden = ['password', 'remember_token'];
    public static $searchable = [
        'name',
        'lastname',
        'email',
    ];
    
    public static function boot()
    {
        parent::boot();

        User::observe(new \App\Observers\UserActionsObserver);
    }
    
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTeamIdAttribute($input)
    {
        $this->attributes['team_id'] = $input ? $input : null;
    }
    
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
    
    public function topics() {
        return $this->hasMany(MessengerTopic::class, 'receiver_id')->orWhere('sender_id', $this->id);
    }

    public function inbox()
    {
        return $this->hasMany(MessengerTopic::class, 'receiver_id');
    }

    public function outbox()
    {
        return $this->hasMany(MessengerTopic::class, 'sender_id');
    }
    public function internalNotifications()
    {
        return $this->belongsToMany(InternalNotification::class)
            ->withPivot('read_at')
            ->orderBy('internal_notification_user.created_at', 'desc')
            ->limit(10);
    }

    public function sendPasswordResetNotification($token)
    {
       $this->notify(new ResetPassword($token));
    }
}
