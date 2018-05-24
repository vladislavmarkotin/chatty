<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getName()
    {
        if($this->first_name){
            return $this->first_name;
        }
    }

    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/{{ md5($this->email) }}? d=mm&s=40";
    }

    public function Statuses()
    {
        return $this->hasMany('App\Statuses', 'user_id');
    }

    public function getId()
    {
        if($this->id){
            return $this->id;
        }
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }

    public function FriendOf()
    {
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted',true)->get()
            ->merge($this->FriendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequest()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending()
    {
        return $this->FriendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('user_id', $user->getId())->count();
    }

    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequest()->where('user_id', $user->getId())->count();
    }

    public function addFriend(User $user)
    {
        $this->FriendOf()->attach($user->getId());
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequest()->where('user_id', $user->getId())->first()->pivot->update(
            ['accepted' => true,]
        );
    }

    public function isFriendWith(User $user)
    {
        return (bool) $this->friends()->where('user_id', $user->getId())->count();
    }

    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

}
