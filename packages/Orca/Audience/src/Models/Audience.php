<?php

namespace Orca\Audience\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Orca\Checkout\Models\CartProxy;
use Orca\Sales\Models\OrderProxy;
use Orca\Product\Models\ProductReviewProxy;
use Orca\Audience\Notifications\AudienceResetPassword;
use Orca\Audience\Contracts\Audience as AudienceContract;

class Audience extends Authenticatable implements AudienceContract, JWTSubject
{
    use Notifiable;

    protected $table = 'audiences';

    protected $fillable = ['first_name', 'channel_id', 'last_name', 'gender', 'date_of_birth', 'email', 'phone', 'password', 'audience_group_id', 'subscribed_to_news_letter', 'is_verified', 'token', 'notes', 'status'];

    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the audience full name.
     */
    public function getNameAttribute() {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    /**
     * Email exists or not
     */
    public function emailExists($email) {
        $results =  $this->where('email', $email);

        if ($results->count() == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the audience group that owns the audience.
     */
    public function group()
    {
        return $this->belongsTo(AudienceGroupProxy::modelClass(), 'audience_group_id');
    }

    /**
    * Send the password reset notification.
    *
    * @param  string  $token
    * @return void
    */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AudienceResetPassword($token));
    }

    /**
     * Get the audience address that owns the audience.
     */
    public function addresses()
    {
        return $this->hasMany(AudienceAddressProxy::modelClass(), 'audience_id');
    }

    /**
     * Get default audience address that owns the audience.
     */
    public function default_address()
    {
        return $this->hasOne(AudienceAddressProxy::modelClass(), 'audience_id')->where('default_address', 1);
    }

    /**
     * Audience's relation with wishlist items
     */
    public function wishlist_items() {
        return $this->hasMany(WishlistProxy::modelClass(), 'audience_id');
    }

    /**
     * get all cart inactive cart instance of a audience
     */
    public function all_carts() {
        return $this->hasMany(CartProxy::modelClass(), 'audience_id');
    }

    /**
     * get inactive cart inactive cart instance of a audience
     */
    public function inactive_carts() {
        return $this->hasMany(CartProxy::modelClass(), 'audience_id')->where('is_active', 0);
    }

    /**
     * get active cart inactive cart instance of a audience
     */
    public function active_carts() {
        return $this->hasMany(CartProxy::modelClass(), 'audience_id')->where('is_active', 1);
    }

    /**
     * get all reviews of a audience
    */
    public function all_reviews() {
        return $this->hasMany(ProductReviewProxy::modelClass(), 'audience_id');
    }

    /**
     * get all orders of a audience
     */
    public function all_orders() {
        return $this->hasMany(OrderProxy::modelClass(), 'audience_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
