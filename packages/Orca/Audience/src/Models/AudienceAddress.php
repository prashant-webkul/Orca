<?php
namespace Orca\Audience\Models;

use Illuminate\Database\Eloquent\Model;
use Orca\Audience\Contracts\AudienceAddress as AudienceAddressContract;

class AudienceAddress extends Model implements AudienceAddressContract
{
    protected $table = 'audience_addresses';

    protected $fillable = ['audience_id' ,'address1', 'country', 'state', 'city', 'postcode', 'phone', 'default_address'];
}
