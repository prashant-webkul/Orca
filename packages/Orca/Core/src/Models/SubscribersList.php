<?php

namespace Orca\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Orca\Core\Contracts\SubscribersList as SubscribersListContract;

class SubscribersList extends Model implements SubscribersListContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'subscribers_list';

    protected $fillable = [
        'email', 'is_subscribed', 'token', 'channel_id'
    ];

    protected $hidden = ['token'];
}