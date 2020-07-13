<?php

namespace App\Services\Contracts;

use App\Models\Item;

/**
 * Interface ItemService
 *
 * @package App\Services\Contracts
 */
interface ItemService extends BaseService
{
    /**
     * Store a newly created resource in storage
     *
     * @param array $data
     * @return Item
     */
    public function store(array $data);

    /**
     * Update block in the storage.
     *
     * @param  int  $id
     * @param  array  $data
     *
     * @return Item
     *
     * @throws
     */
    public function update($id, array $data);

    /**
     * Delete item.
     *
     * @param  int  $id
     *
     * @return array
     *
     * @throws
     */
    public function delete($id);
}
