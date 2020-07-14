<?php

namespace App\Services;

use App\Exceptions\UnexpectedErrorException;
use App\Models\Currency;
use App\Models\DeliveryInfo;
use App\Models\Item;
use App\Models\Order;
use App\Models\Language;
use App\Models\OrderItems;
use App\Repositories\Contracts\DeliveryInfoRepository;
use App\Repositories\Contracts\OrderRepository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Log\Logger;
use Exception;
use App\Services\Contracts\OrderService as OrderServiceInterface;
use Illuminate\Support\Arr;

/**
 * @method bool destroy
 */
class OrderService  extends BaseService implements OrderServiceInterface
{

    /**
     * @var DatabaseManager $databaseManager
     */
    protected $databaseManager;

    /**
     * @var OrderRepository $repository
     */
    protected $repository;

    /**
     * Language $language
     */
    protected $language;

    /**
     * @var Logger $logger
     */
    protected $logger;

    /**
     * @var DeliveryInfoRepository
     */
    protected $deliveryInfoRepository;

    /**
     * OrderService constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param OrderRepository $repository
     * @param Language $language
     * @param Logger $logger
     * @param DeliveryInfoRepository $deliveryInfoRepository
     */
    public function __construct(
        DatabaseManager $databaseManager,
        OrderRepository $repository,
        Language $language,
        Logger $logger,
        DeliveryInfoRepository $deliveryInfoRepository
    ) {

        $this->databaseManager = $databaseManager;
        $this->repository      = $repository;
        $this->logger          = $logger;
        $this->language        = $language;
        $this->deliveryInfoRepository        = $deliveryInfoRepository;
    }

    /**
     * @param array $data
     * @return Order
     * @throws \Throwable
     */
    public function store(array $data)
    {
        $this->beginTransaction();
        try {
            /** @var Order $order */
            $order = $this->repository->newInstance();
            $order->status = Order::STATUS_PROCESS;

            /** @var DeliveryInfo $deliveryInfo */
            $deliveryInfo = $this->deliveryInfoRepository->create(array_get($data, 'delivery'));

            $currency = Currency::where('code', array_get($data, 'selectedCurrency'))->first();

            $order->currency_id = $currency->id;

            $order->delivery_info_id = $deliveryInfo->id;

            $order->no = rand(11111, 99999);

            $inputItems = array_get($data, 'items');

            $order->total_cost = $this->getTotalCost($inputItems, $currency->code);

            if (!$order->save()) {
                throw new UnexpectedErrorException('Order was not saved to the database.');
            }

            foreach ($inputItems as $item) {
                Arr::forget($item, 'prices');
                $order->orderItems()->create($item);
            }

            $this->logger->info('Order was successfully saved to the database.');

        } catch (UnexpectedErrorException $e) {
            $this->rollback($e, 'An error occurred while storing an ', [
                'data' => $data,
            ]);
        }

        $this->commit();
        return $order;
    }

    /**
     * Calculate total cost
     *
     * @param $itemsInput
     * @param $currencyCode
     * @return float|int
     */
    protected function getTotalCost($itemsInput, $currencyCode) {
        $totalCost = 0;
        foreach ($itemsInput as $item) {
            /** @var Item $itemModel */
            $itemModel= Item::find($item['item_id']);
            $itemPrice = $itemModel->getPricesDataAttribute()[$currencyCode];
            $totalCost += $item['qty'] * $itemPrice;
        }
        return $totalCost;
    }

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
    public function update($id, array $data)
    {
        $this->beginTransaction();
        try {
            /** @var Order $order */
            $order = $this->repository->find($id);

            if (!$order->save()) {
                throw new UnexpectedErrorException('An error occurred while updating a Order');
            }
            $this->logger->info('Order was successfully updated.');

        } catch (UnexpectedErrorException $e) {
            $this->rollback($e, 'An error occurred while updating an Orders.', [
                'id'   => $id,
                'data' => $data,
            ]);
        }
        $this->commit();
        return $order;
    }

    /**
     * Delete order.
     *
     * @param  int  $id
     *
     * @return array
     *
     * @throws
     */
    public function delete($id)
    {

        $this->beginTransaction();

        try {
            $bufferOrder = [];
            $order = $this->repository->find($id);

            $bufferOrder['id'] = $order->id;
            $bufferOrder['name'] = $order->name;

            if (!$order->delete($id)) {
                throw new UnexpectedErrorException(
                    'Order and Order translations was not deleted from database.'
                );
            }
            $this->logger->info('Order Order was successfully deleted from database.');
        } catch (UnexpectedErrorException $e) {
            $this->rollback($e, 'An error occurred while deleting an Order.', [
                'id'   => $id,
            ]);
        }
        $this->commit();
        return $bufferOrder;
    }
}
