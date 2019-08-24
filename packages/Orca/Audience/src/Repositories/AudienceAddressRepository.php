<?php

namespace Orca\Audience\Repositories;

use Orca\Core\Eloquent\Repository;

/**
 * Audience Reposotory
 *
 * @author    Prashant Singh <>
 *
 */

class AudienceAddressRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */

    function model()
    {
        return 'Orca\Audience\Contracts\AudienceAddress';
    }
}