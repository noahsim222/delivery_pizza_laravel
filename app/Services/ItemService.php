<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Language;
use App\Repositories\Contracts\ItemRepository;
use App\Services\EntityService\BaseService;
use App\Services\Traits\ServiceTranslateTable;
use Illuminate\Database\DatabaseManager;
use Illuminate\Log\Logger;
use Illuminate\Support\Arr;
use Exception;
use App\Services\Contracts\ItemService as ItemServiceInterface;

/**
 * @method bool destroy
 */
class ItemService  extends BaseService implements ItemServiceInterface
{
    use ServiceTranslateTable;

    /**
     * @var DatabaseManager $databaseManager
     */
    protected $databaseManager;

    /**
     * @var ItemRepository $repository
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
     * ItemService constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param ItemRepository $repository
     * @param Language $language
     * @param Logger $logger
     */
    public function __construct(
        DatabaseManager $databaseManager,
        ItemRepository $repository,
        Language $language,
        Logger $logger
    ) {

        $this->databaseManager = $databaseManager;
        $this->repository      = $repository;
        $this->logger          = $logger;
        $this->language        = $language;
    }

    /**
     * @param array $data
     * @return Item
     * @throws \Throwable
     */
    public function store(array $data)
    {
        $this->beginTransaction();
        try {
            /** @var Item $item */
            $item = $this->repository->newInstance();
            $item->status = Item::STATUS_DRAFT;
            $item->category_id = array_get($data, 'category_id');
            $item->img = array_get($data, 'img');
            
            if (!$item->save()) {
                throw new Exception('Item was not saved to the database.');
            }
            $this->logger->info('Item was successfully saved to the database.');

            $this->storeTranslations($item, $data, $this->getTranslationSelectColumnsClosure());
            $this->logger->info('Translations for the Item were successfully saved.', ['Item_id' => $item->id]);

        } catch (Exception $e) {
            $this->rollback($e, 'An error occurred while storing an ', [
                'data' => $data,
            ]);
        }

        $this->commit();
        return $item;
    }

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
    public function update($id, array $data)
    {
        $this->beginTransaction();
        try {
            /** @var Item $item */
            $item = $this->repository->find($id);

            $item->category_id = array_get($data, 'category_id');
            $item->img = array_get($data, 'img');

            if (!$item->save()) {
                throw new Exception('An error occurred while updating a Item');
            }
            $this->logger->info('Item was successfully updated.');

            $this->storeTranslations($item, $data, $this->getTranslationSelectColumnsClosure());
            $this->logger->info('Item translations was successfully updated.');

        } catch (Exception $e) {
            $this->rollback($e, 'An error occurred while updating an Items.', [
                'id'   => $id,
                'data' => $data,
            ]);

        }
        $this->commit();
        return $item;
    }

    /**
     * Delete item.
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
            $bufferItem = [];
            $item = $this->repository->find($id);

            $bufferItem['id'] = $item->id;
            $bufferItem['name'] = $item->name;

            if (!$item->delete($id)) {
                throw new Exception(
                    'Item and Item translations was not deleted from database.'
                );
            }
            $this->logger->info('Item Item was successfully deleted from database.');
        } catch (Exception $e) {
            $this->rollback($e, 'An error occurred while deleting an Item.', [
                'id'   => $id,
            ]);
        }
        $this->commit();
        return $bufferItem;
    }

    /**
     * Closure that handles translation for storing in the database.
     *
     * @return \Closure
     */
    protected function getTranslationSelectColumnsClosure()
    {
        return function ($translation) {
            return [
                'name' => Arr::get($translation, 'name'),
                'title' => Arr::get($translation, 'title'),
                'description' => Arr::get($translation, 'description'),
            ];
        };
    }
}
