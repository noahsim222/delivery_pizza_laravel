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
     * @param array $input
     * @return Order
     */
    public function store(array $input);

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
