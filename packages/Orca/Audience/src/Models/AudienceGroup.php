<?php
namespace Orca\Audience\Models;

use Illuminate\Database\Eloquent\Model;
use Orca\Audience\Contracts\AudienceGroup as AudienceGroupContract;

class AudienceGroup extends Model implements AudienceGroupContract
{
    protected $table = 'audience_groups';

    protected $fillable = ['name', 'code', 'is_user_defined'];

    /**
     * Get the audience for this group.
    */
    public function audience()
    {
        return $this->hasMany(AudienceProxy::modelClass());
    }
}
