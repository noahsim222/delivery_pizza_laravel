<?php

namespace App\Services\Contracts;

use App\Models\Order;

/**
 * Interface OrderService
 *
 * @package App\Services\Contracts
 */
interface OrderService extends BaseService
{
    /**
     * Store a newly created resource in storage
     *
     * @param array $data
     * @return mixed
     */
    public function store(array $data);

    /**
     * Update block in the storage.
     *
     * @param  int  $id
     * @param  array  $data
     *
     * @return Order
     *
     * @throws
     */
    public function update($id, array $data);

    /**
     * Delete order.
     *
     * @param  int  $id
     *
     * @return array
     *
     * @throws
     */
    public function delete($id);
}
