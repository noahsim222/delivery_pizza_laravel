<?php
use Illuminate\Support\Arr;
use App\Models\Order;

if (! function_exists('array_get')) {
    /**
     * Get an item from an array using "dot" notation.
     *
     * @param $array
     * @param $key
     * @param null $default
     * @return mixed
     */
    function array_get($array, $key, $default = null)
    {
        return Arr::get($array, $key, $default);
    }
}

if (! function_exists('order_status_message')) {

    /**
     * @param int $status
     * @return mixed
     */
    function order_status_message(int $status)
    {
        $message = 'Waiting!';

        switch ($status) {
            case Order::STATUS_PROCESS:
                $message = 'Your order has been accepted. Now in the cooking process.';
                return $message;
                break;
            case Order::STATUS_DELIVERY:
                $message = 'Your order has been accepted. Now in the process of delivery.';
                return $message;
                break;
            case Order::STATUS_ACCEPTED:
                $message = 'Your order has been delivered.';
                return $message;
                break;
            case Order::STATUS_CANCELLED:
                $message = 'Sorry, your order has been canceled. You can contact us.';
                return $message;
                break;
        }

        return $message;

    }
}