<?php

namespace Orca\Audience\Repositories;

use Orca\Core\Eloquent\Repository;

/**
 * AudienceGroup Reposotory
 *
 * @author     <>
 *
 */

class AudienceGroupRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */

    function model()
    {
        return 'Orca\Audience\Contracts\AudienceGroup';
    }

    /**
     * @param array $data
     * @return mixed
     */

    public function create(array $data)
    {
        $audience = $this->model->create($data);

        return $audience;
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */

    public function update(array $data, $id, $attribute = "id")
    {
        $audience = $this->find($id);

        $audience->update($data);

        return $audience;
    }
}