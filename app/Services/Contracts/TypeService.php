<?php

namespace App\Services\Contracts;

use App\Models\Type;

/**
 * Interface TypeService
 *
 * @package App\Services\Contracts
 */
interface TypeService extends BaseService
{
    /**
     * Store a newly created resource in storage
     *
     * @param array $data
     * @return Type
     */
    public function store(array $data);

    /**
     * Update block in the storage.
     *
     * @param  int  $id
     * @param  array  $data
     *
     * @return Type
     *
     * @throws
     */
    public function update($id, array $data);

    /**
     * Delete type.
     *
     * @param  int  $id
     *
     * @return array
     *
     * @throws
     */
    public function delete($id);
}
